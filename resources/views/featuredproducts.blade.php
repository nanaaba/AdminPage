@extends('layouts.forms')

@section('content')


<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">Featured Items</h2>
        <ol class="breadcrumb page-head-nav">
            <li><a href="#">Home</a></li>
            <li><a href="#">Products</a></li>
            <li class="active">Featured</li>
        </ol>
    </div>
    <div class="main-content container-fluid">

        <div id="errormsg">
            <div role="alert" id="successdiv" class="alert alert-success alert-icon alert-dismissible"  style="display: none">
                <div class="icon"><span class="mdi mdi-check"></span></div>
                <div class="message">
                    <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button>
                    <span class="feedback"></span>
                </div>
            </div> 
            <div id="errordiv" role="alert" class="alert alert-danger alert-icon alert-dismissible"  style="display: none">
                <div class="icon"><span class="mdi mdi-close"></span></div>
                <div class="message">
                    <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button>
                    <span class="feedback"></span>
                </div>
            </div>
        </div>

        <div class="row"  >
            <div class="col-lg-12">
                <div class="pull-right">
                    <button data-toggle="modal" data-target="#newModal" type="button" class="btn btn-space btn-primary">New </button>
                    <!--                    <a  class="btn btn-primary" href="bulk-beneficiary-upload" >New Category</a>-->

                </div>

            </div>

        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default table-responsive">

                    <div class="panel-body">
                        <table id="productTbl" class="table table-condensed table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Name</th> 
                                    <th>Category</th> 
                                    <th>Price</th> 
                                    <th>Quantity</th> 
                                    <th>Date Added</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div id="newModal" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary">
            <div class="modal-dialog custom-width">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
                        <h3 class="modal-title">New Featured Items</h3>
                    </div>
                    <form id="addForm">
                        <div class="modal-body">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Items</label>
                                    <div class="col-sm-8">
                                        <select class="select2" multiple name="items[]" id="items">

                                        </select>
                                    </div>
                                </div>
                            </div>




                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
                            <button type="submit" class="btn btn-info ">Proceed</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('customjs')

<script type="text/javascript">
    $(document).ready(function () {
        //initialize the javascript
        App.init();
        App.dataTables();
        //   $('.loader').addClass('be-loading-active');

    });
    var datatable = $('#productTbl').DataTable();

    function deleteitem(id) {
        $('#itemid').val(id);
        $('#removeModal').modal('show');
    }

<?php
$url = config('constants.TEST_URL');

?>

    $('#addForm').on('submit', function (e) {

        e.preventDefault();
        var formData = new FormData($(this)[0]);
        console.log(formData);
        //  var formData = new FormData($(this)[0]);
//add class to div
        $('.loader').addClass('be-loading-active');
        $('#newModal').modal('hide');

        $.ajax({
            url: "{{url('product/addfeatureditem')}}",
            type: "POST",
            data: formData,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (data) {
                $('.loader').removeClass('be-loading-active');
                console.log('server data :' + data);
                var status = data.status;
                if (status == 0) {
                    document.getElementById("addForm").reset();
                    getProducts();

                    $('.feedback').html(data.message);
                    $('#successdiv').show();
                    $('#errordiv').hide();

                }
                if (status == 1) {
                    $('.feedback').html(data.message);
                    $('#errordiv').show();
                    $('#successdiv').hide();
                }

            }

        });
    });

    getProducts();

//
    $('#removeForm').on('submit', function (e) {

        e.preventDefault();
        var itemid = $('#itemid').val();
        var token = $('#token').val();
        $('#removeModal').modal('hide');
        $('.loader').addClass('be-loading-active');
        $.ajax({
            url: "removefeatured/" + itemid,
            type: "DELETE",
            data: {_token: token},
            dataType: 'json',
            success: function (data) {


                $('.loader').removeClass('be-loading-active');
                console.log('server data :' + data);
                var status = data.status;
                if (status == 0) {
                    getProducts();
                    document.getElementById("removeForm").reset();
                    $('.feedback').html(data.message);
                    $('#successdiv').show();
                    $('#errordiv').hide();
                }
                if (status == 1) {
                    $('.feedback').html(data.message);
                    $('#errordiv').show();
                    $('#successdiv').hide();
                }

            }



        });
    });


    function getProducts() {
      $('.loader').addClass('be-loading-active');
        $.ajax({
            url: "{{url('product/featureditems')}}",
            type: "GET",
            dataType: 'json',
            success: function (data) {
                
                console.log('server data :' + data.data);
                var dataSet = data.data;
                console.log(dataSet);
                datatable.clear().draw();
                console.log('size' + dataSet.length);
                if (dataSet.length == 0) {
                    console.log("NO DATA!");
                } else {
                    $.each(dataSet, function (key, value) {


                        var j = -1;
                        var r = new Array();
                        // represent columns as array
                        r[++j] = '<td class="user-avatar"> <img src="<?php echo $url?>/images/' + value.iconUrl + '"  height="20" width="20" alt="Avatar"></td>';
                        r[++j] = '<td class="subject"> ' + value.name + '</td>';
                        r[++j] = '<td class="subject">' + value.category + '</td>';
                        r[++j] = '<td class="subject">' + value.price + '</td>';
                        r[++j] = '<td class="subject">' + value.quantity + '</td>';
                        r[++j] = '<td class="subject">' + value.dateCreated + '</td>';
                        r[++j] = '<td class="actions">' +
                                '<a  href="#" onclick="deleteitem(' + value.itemID + ')" type="button" class="icon btn btn-outline-info btn-sm  col-sm-6 btn-edit editBtn" ><i title ="Delete" class="mdi mdi-delete""></i><span class="hidden-md hidden-sm hidden-xs"> </span></a>' +
                                '</td>';
                        rowNode = datatable.row.add(r);
                    });
                    rowNode.draw().node();
                }

                $('.loader').removeClass('be-loading-active');
            }

        });
    }

    $.ajax({
        url: "{{url('product/allitems')}}",
        type: "GET",
        dataType: 'json',
        success: function (data) {

            var dataSet = data.data;
            $.each(dataSet, function (i, item) {

                $('#items').append($('<option>', {
                    value: item.itemID,
                    text: item.name
                }));
            });

        }
    });
</script>
@endsection


@extends('layouts.master')

@section('content')


<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">Items</h2>
        <ol class="breadcrumb page-head-nav">
            <li><a href="#">Home</a></li>
            <li><a href="#">Items</a></li>
            <li class="active">All</li>
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
        $('#deleteModal').modal('show');
    }

    getProducts();


    $('#deleteForm').on('submit', function (e) {

        e.preventDefault();
        var itemid = $('#itemid').val();
        var token = $('#token').val();
        $('#deleteModal').modal('hide');
        $('.loader').addClass('be-loading-active');
        $.ajax({
            url: "deleteitem/" + itemid,
            type: "DELETE",
            data: {_token: token},
            dataType: 'json',
            success: function (data) {


                $('.loader').removeClass('be-loading-active');
                console.log('server data :' + data);
                var status = data.status;
                if (status == 0) {
                    getProducts();
                    document.getElementById("deleteForm").reset();
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
            url: "{{url('product/allitems')}}",
            type: "GET",
            dataType: 'json',
            success: function (data) {
                if (data.status == 1) {
                    alert(data.message);
                    $('.loader').removeClass('be-loading-active');
                    return;
                }
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
                        r[++j] = '<td class="user-avatar"> <img src="http://tfs.knust.edu.gh/ecommerce/images/' + value.iconUrl + '"  height="20" width="20" alt="Avatar"></td>';
                        r[++j] = '<td class="subject"> ' + value.name + '</td>';
                        r[++j] = '<td class="subject">' + value.category + '</td>';
                        r[++j] = '<td class="subject">' + value.price + '</td>';
                        r[++j] = '<td class="subject">' + value.quantity + '</td>';
                        r[++j] = '<td class="subject">' + value.dateCreated + '</td>';
                        r[++j] = '<td class="actions">' +
                                '<a  href="detail/' + value.itemID + '"  type="button" class="icon btn btn-outline-info btn-sm  col-sm-6 btn-edit editBtn" ><i title="View" class="mdi mdi-eye""></i><span class="hidden-md hidden-sm hidden-xs"> </span></a>' +
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
</script>
@endsection


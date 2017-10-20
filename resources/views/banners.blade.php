@extends('layouts.forms')

@section('content')


<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">Banners</h2>
        <ol class="breadcrumb page-head-nav">
            <li><a href="#">Home</a></li>

            <li class="active">Banners</li>
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
                    <button data-toggle="modal" data-target="#newcategory" type="button" class="btn btn-space btn-primary">New Banner</button>
                    <!--                    <a  class="btn btn-primary" href="bulk-beneficiary-upload" >New Category</a>-->

                </div>

            </div>

        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default table-responsive">

                    <div class="panel-body">
                        <table id="categoryTbl" class="table table-condensed table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Url</th>
                                    <th>Title</th>  
                                    <th>Type</th>
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

<!--Form Modals-->
<div id="newcategory" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary">
    <div class="modal-dialog custom-width">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
                <h3 class="modal-title">New Category</h3>
            </div>
            <form id="bannerForm">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Type</label>

                        <select class="select2 form-control" id='type' name="type" style="width: 100%" >
                            <option value="">Select --</option>
                            <option value="category">Category</option>    
                            <option value="promotion">Promotion</option>
                            <option value="item">Item</option>
                        </select>

                    </div>

                    <div class="form-group" id='categorydiv' style="display:none">
                        <label class=" control-label">Categories</label>

                        <select class="select2 form-control" id='categories' name="categories" >
                            <option value="">Select --</option>

                        </select>

                    </div>

                    <div class="form-group" id='promotiondiv' style="display:none">
                        <label class="control-label">Promotions</label>

                        <select class="select2 form-control" id='promotions' name="promotions" >
                            <option value="">Select --</option>

                        </select>



                    </div>

                    <div class="form-group" id='itemsdiv' style="display:none">
                        <label class="control-label">Items</label>

                        <select class="select2 form-control" id='items' name="items" >
                            <option value="">Select --</option>

                        </select>

                    </div>



                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Category Banner</label>
                            <div class="col-sm-8">
                                <input type="file" name="banner"    class="form-control">
                                <label for="file-1" class="btn-default"> 
                                </label>
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

@endsection

@section('customjs')

<script type="text/javascript">
    $(document).ready(function () {
        //initialize the javascript
        App.init();
        App.dataTables();
        //   $('.loader').addClass('be-loading-active');

    });

    var datatable = $('#categoryTbl').DataTable();

    getBanners();

    $('.loader').addClass('be-loading-active');

    function getBanners() {
        $.ajax({
            url: "{{url('banner/all')}}",
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
                        r[++j] = '<td class="user-avatar"> <img src="http://tfs.knust.edu.gh/ecommerce/images/' + value.bannerUrl + '"  height="50" width="50" alt="Avatar"></td>';
                        r[++j] = '<td class="subject"> ' + value.title + '</td>';
                        r[++j] = '<td class="subject">' + value.type + '</td>';

                        r[++j] = '<td class="actions">' +
                                '<a  href="#" onclick="deleteBanner(' + value.bannerID + ')" type="button" class="icon btn btn-outline-info btn-sm  col-sm-6 btn-edit editBtn" ><i title ="Delete" class="mdi mdi-delete""></i><span class="hidden-md hidden-sm hidden-xs"> </span></a>' +
                                '</td>';
                        rowNode = datatable.row.add(r);
                    });
                    rowNode.draw().node();
                }

                $('.loader').removeClass('be-loading-active');
            }

        });
    }


    function deleteBanner(id) {
        $('#itemid').val(id);
        $('#deleteModal').modal('show');
    }


    $('#bannerForm').on('submit', function (e) {

        e.preventDefault();
        var formData = new FormData($(this)[0]);
        console.log(formData);
        //  var formData = new FormData($(this)[0]);
//add class to div
        $('#newcategory').modal('hide');
        $('.loader').addClass('be-loading-active');
        $.ajax({
            url: "{{url('banner/save')}}",
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
                    $('#newcategory').modal('hide');
                    document.getElementById("bannerForm").reset();

                    $('.feedback').html(data.message);
                    $('#successdiv').show();
                    $('#errordiv').hide();
                    getBanners();

                }
                if (status == 1) {
                    $('.feedback').html(data.message);
                    $('#errordiv').show();
                    $('#successdiv').hide();
                }

            }

        });
    });


    $('#deleteForm').on('submit', function (e) {

        e.preventDefault();
        var itemid = $('#itemid').val();
        var token = $('#token').val();
        $('#deleteModal').modal('hide');
        $('.loader').addClass('be-loading-active');

        $.ajax({
            url: "banner/" + itemid,
            type: "DELETE",
            data: {_token: token},
            dataType: 'json',
            success: function (data) {


                $('.loader').removeClass('be-loading-active');
                console.log('server data :' + data);
                var status = data.status;
                if (status == 0) {
                    getBanners();
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

    $('#type').change(function () {
        var val = $(this).val();
        console.log('val is ' + val);

        if (val == "category") {
            $('#categorydiv').show();
            $('#promotiondiv').hide();
            $('#itemsdiv').hide();
        }
        if (val == "promotion") {
            $('#categorydiv').hide();
            $('#promotiondiv').show();
            $('#itemsdiv').hide();
        }
        if (val == "item") {
            $('#categorydiv').hide();
            $('#promotiondiv').hide();
            $('#itemsdiv').show();
        }
    });

    $.ajax({
        url: "{{url('promotions/all')}}",
        type: "GET",
        dataType: 'json',
        success: function (data) {

            var dataSet = data.data;
            $.each(dataSet, function (i, item) {

                $('#promotions').append($('<option>', {
                    value: item.promotionID,
                    text: item.name
                }));
            });

        }
    });
    $.ajax({
        url: "{{url('category/all')}}",
        type: "GET",
        dataType: 'json',
        success: function (data) {

            var dataSet = data.data;
            $.each(dataSet, function (i, item) {

                $('#categories').append($('<option>', {
                    value: item.categoryID,
                    text: item.name
                }));
            });

        }
    });
</script>
@endsection



@extends('layouts.forms')

@section('content')





<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title"> {{$promodata[0]['name']}} Information</h2>
        <ol class="breadcrumb page-head-nav">
            <li><a href="#">Home</a></li>
            <li><a href="{{url('category')}}">Promotions</a></li>
            <li class="active">Promotion Detail</li>
        </ol>
    </div>
    <div class="main-content container-fluid">
        <!--Basic forms-->
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
                <div class="panel panel-default panel-border-color panel-border-color-primary">
                    <div class="panel-heading panel-heading-divider"> {{$promodata[0]['name']}} Information
                        <div class="panel-body">

                            <form id="updateForm" enctype="multipart/form-data">

                                {{ csrf_field() }}
                            <input type="hidden" name="promotionId" value="{{$promodata[0]['promotionID']}}"/>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control"  value="{{$promodata[0]['name']}}">
                                </div>
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="date" name="startdate"  class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="date" name="enddate" value="{{$promodata[0]['expiryDate']}}"  class="form-control">
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Category Banner</label>
                                        <div class="col-sm-6">
                                            <input type="file" name="banner"    class="form-control">
                                            <label for="file-1" class="btn-default"> 
                                            </label>
                                        </div>
                                    </div>

                                    <img src="http://tfs.knust.edu.gh/ecommerce/images/{{$promodata[0]['bannerUrl']}}" height="50" width="50" alt="No image" />

                                </div>
                                <div class="row xs-pt-15">
                                    <div class="col-xs-6">

                                    </div>
                                    <div class="col-xs-6">
                                        <p class="text-right">
                                            <button type="submit" class="btn btn-space btn-primary">Update</button>

                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="row"  >
            <div class="col-lg-12">
                <div class="pull-right">
                    <button data-toggle="modal" data-target="#newcategory" type="button" class="btn btn-space btn-primary">New Promotion Item</button>
                    <!--                    <a  class="btn btn-primary" href="bulk-beneficiary-upload" >New Category</a>-->

                </div>

            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <h4>Items</h4>
                <div class="panel panel-default table-responsive">


                    <div class="panel-body">
                        <table id="itemsTbl" class="table table-condensed table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Name</th>  

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (sizeof($promodata[0]['items']) > 0) {

                                    foreach ($promodata[0]['items'] as $value) {
                                        echo '<tr>'
                                        . '<td><img src="http://tfs.knust.edu.gh/ecommerce/images/' . $value['bannerUrl'] . '"  height="20" width="20" alt="Avatar"></td>'
                                        . '<td>' . $value['title'] . '</td>'
                                        . '<td><a  href="#" onclick="removeItem(' . $value['itemID'] . ')" type="button" class="icon btn btn-outline-info btn-sm  col-sm-6 btn-edit editBtn" ><i title ="Delete" class="mdi mdi-delete""></i><span class="hidden-md hidden-sm hidden-xs"> </span></a></td>'
                                        . '</tr>';
                                    }
                                }
                                ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <h4>Categories</h4>
                <div class="panel panel-default table-responsive">

                    <div class="panel-body">
                        <table id="categoryTbl" class="table table-condensed table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Name</th>  

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (sizeof($promodata[0]['categories']) > 0) {
                                    foreach ($promodata[0]['categories'] as $value) {
                                        echo '<tr>'
                                        . '<td><img src="http://tfs.knust.edu.gh/ecommerce/images/' . $value['bannerUrl'] . '"  height="20" width="20" alt="Avatar"></td>'
                                        . '<td>' . $value['title'] . '</td>'
                                        . '<td><a  href="#" onclick="removeItem(' . $value['itemID'] . ')" type="button" class="icon btn btn-outline-info btn-sm  col-sm-6 btn-edit editBtn" ><i title ="Delete" class="mdi mdi-delete""></i><span class="hidden-md hidden-sm hidden-xs"> </span></a></td>'
                                        . '</tr>';
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
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
                        <h3 class="modal-title">New Promotion Item</h3>
                    </div>
                    <form id="promotionitemForm">
                        <div class="modal-body">
                            {{ csrf_field() }}

                            <input type="hidden" name="promotionId" value="{{$promodata[0]['promotionID']}}"/>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label class="control-label">Type</label>

                                <select class="select2 form-control" id='type' name="type" style="width: 100%" >
                                    <option value="">Select --</option>
                                    <option value="category">Category</option>    

                                    <option value="item">Item</option>
                                </select>

                            </div>

                            <div class="form-group" id='categorydiv' style="display:none">
                                <label class=" control-label">Categories</label>

                                <select class="select2 form-control" id='categories' name="categories" >
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
                                    <label class="col-sm-4 control-label"> Banner</label>
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
        var itemdatatable = $('#itemsTbl').DataTable();


        $('#updateForm').on('submit', function (e) {

            e.preventDefault();
            var formData = new FormData($(this)[0]);
            console.log(formData);

            $('.loader').addClass('be-loading-active');
            $.ajax({
                url: "{{url('promotion/update')}}",
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
                        document.getElementById("updateForm").reset();

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
        
        
        //promotionitemForm
        
         $('#promotionitemForm').on('submit', function (e) {

            e.preventDefault();
            var formData = new FormData($(this)[0]);
            console.log(formData);

            $('.loader').addClass('be-loading-active');
            $.ajax({
                url: "{{url('promotion/item/save')}}",
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
                        document.getElementById("promotionitemForm").reset();

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

            if (val == "item") {
                $('#categorydiv').hide();
                $('#promotiondiv').hide();
                $('#itemsdiv').show();
            }
        });


    </script>


    @endsection
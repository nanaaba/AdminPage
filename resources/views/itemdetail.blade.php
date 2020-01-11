@extends('layouts.forms')

@section('content')

<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">{{$itemdata->name}} </h2>
        <ol class="breadcrumb page-head-nav">
            <li><a href="#">Home</a></li>
            <li><a href="{{url('product/all')}}">Items</a></li>
            <li class="active">Item Detail</li>
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
                    <div class="panel-heading panel-heading-divider">{{$itemdata->name}} Information
                        <div class="panel-body">
                            <form id="itemForm" enctype="multipart/form-data">

                                {{ csrf_field() }}
                                <input type="hidden" name="barcode" value="1235554"/>
                                <input type="hidden" name="itemid" value="{{$itemdata->itemID}}"/>
                                <input type="hidden" name="catid" id="catid" value="{{$itemdata->categoryID}}"/>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label> Name</label>
                                        <input type="text" value="{{$itemdata->name}}" name="name"  class="form-control" required>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label> Category</label>
                                        <select class="select2" name="categoryid" id="categories">
                                            <option value="2">Select --</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="text" value="{{$itemdata->price}}" name="price" class="form-control" required>
                                    </div>

                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="text"  value="{{$itemdata->quantity}}" name="quantity" class="form-control" required>
                                    </div>

                                </div>

                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Description</label>
                                        <div>
                                            <textarea name="description" class="form-control">
                                                 {{$itemdata->description}}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Ingredients</label>
                                        <div>
                                            <textarea name="ingredients" class="form-control">
                                                {{$itemdata->ingredients}}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Item Icon</label>
                                        <div class="col-sm-6">
                                            <input type="file" name="icon" id="file-1" class="form-control">
                                            <label for="file-1" class="btn-default"> 
                                            </label>
                                        </div>

                                        <img src="http://18.217.149.24/ecommerce/images/{{$itemdata->iconUrl}}" height="50" width="50" alt="No image" />
                                    </div>
                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Item Banner</label>
                                        <div class="col-sm-6">
                                            <input type="file" name="banner"    class="form-control">
                                            <label for="file-1" class="btn-default">  </label>
                                        </div>

                                        <img src="http://18.217.149.24/ecommerce/images/{{$itemdata->bannerUrl}}" height="50" width="50" alt="No image" />

                                    </div>
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
    </div>
    @endsection

    @section('customjs')
    <script type="text/javascript">

        $('#itemForm').on('submit', function (e) {

            e.preventDefault();
            var formData = new FormData($(this)[0]);
            console.log(formData);

            $('.loader').addClass('be-loading-active');
            $.ajax({
                url: "{{url('product/updateitem')}}",
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
                        document.getElementById("itemForm").reset();

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
                
              var catid =  $('#catid').val();
                 $('#categories').val(catid);
              $('#categories').change();
                $('#loaderModal').modal('hide');
            }
        });
    </script>
    @endsection
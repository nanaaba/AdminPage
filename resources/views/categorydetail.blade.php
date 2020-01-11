@extends('layouts.forms')

@section('content')

<?php
$items = json_decode($itemdata, true);
$data = $items['data'];
?>



<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title"> {{ $data[0]['name']}} Information</h2>
        <ol class="breadcrumb page-head-nav">
            <li><a href="#">Home</a></li>
            <li><a href="{{url('category')}}">Categories</a></li>
            <li class="active">Category Detail</li>
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
                    <div class="panel-heading panel-heading-divider">{{ $data[0]['name']}} Information
                        <div class="panel-body">

                            <form id="updateForm" enctype="multipart/form-data">

                                {{ csrf_field() }}
                                <input type="hidden" name="catid" id="catid" value="{{ $data[0]['categoryID']}}"/>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control"  value="{{ $data[0]['name']}}">
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Category Icon</label>
                                        <div class="col-sm-6">
                                            <input type="file" name="icon"   class="form-control ">
                                            <label for="file-1" class="btn-default"> 
                                                </span></label>
                                        </div>
                                        
                                        <img src="http://18.217.149.24/ecommerce/images/{{$data[0]['iconUrl']}}" height="50" width="50" alt="No image" />

                                    </div>
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

                                    <img src="http://18.217.149.24/ecommerce/images/{{$data[0]['bannerUrl']}}" height="50" width="50" alt="No image" />

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

        $('#updateForm').on('submit', function (e) {

            e.preventDefault();
            var formData = new FormData($(this)[0]);
            console.log(formData);

            $('.loader').addClass('be-loading-active');
            $.ajax({
                url: "{{url('category/update')}}",
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

       
    </script>


    @endsection
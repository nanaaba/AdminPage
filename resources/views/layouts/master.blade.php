<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="{{ asset('assets/img/logo-fav.png')}}">
        <title>KoalaAdmin</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/material-design-icons/css/material-design-iconic-font.min.css')}}"/><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/jqvmap/jqvmap.min.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/datetimepicker/css/bootstrap-datetimepicker.min.css')}}"/>
        <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/daterangepicker/css/daterangepicker.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/select2/css/select2.min.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/bootstrap-slider/css/bootstrap-slider.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/datatables/css/dataTables.bootstrap.min.css')}}"/>

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowgroup/1.0.2/css/rowGroup.dataTables.min.css"/>



    </head>
    <body>
        <div class="be-wrapper be-fixed-sidebar">
            @include('layouts.header')

            @include('layouts.nav')

            <div class="be-loading loader ">
                @yield('content')



                <!-- Here goes your content -->

                <div class="be-spinner ">
                    <svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                    <circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
                    </svg>
                </div>
                <div id="deleteModal" tabindex="-1" role="dialog" class="modal fade in" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
                        </div>
                        <form id="deleteForm">
                            <input type="hidden" name="_token" id="token" value="<?php echo csrf_token() ?>"/>

                            <input type="hidden" name="itemid" id="itemid"/>
                            <div class="modal-body">
                                <div class="text-center">
                                    <div class="text-primary">
                                        <span class="modal-main-icon mdi mdi-info-outline"></span></div>
                                    <h3>Information!</h3>
                                    <p>Are you sure you want to delete?</p>
                                    <div class="xs-mt-50"> 
                                        <button type="button" data-dismiss="modal" class="btn btn-space btn-default">Cancel</button>
                                        <button type="submit"  class="btn btn-space btn-primary">Proceed</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="modal-footer"></div>
                    </div>
                </div>
            </div>

            </div>

            
            @include('layouts.footer')

        </div>
        @yield('customjs')
    </body>
</html>
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
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js')}}"></script>
        <script src="https://oss.maxcsedn.com/respond/1.4.2/respond.min.js')}}"></script>
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/datetimepicker/css/bootstrap-datetimepicker.min.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/daterangepicker/css/daterangepicker.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/select2/css/select2.min.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/bootstrap-slider/css/bootstrap-slider.css')}}"/>
        <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/datatables/css/dataTables.bootstrap.min.css')}}"/>
        <style type="text/css">


        </style>
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

                <div id="removeModal" tabindex="-1" role="dialog" class="modal fade in" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
                            </div>
                            <form id="removeForm">
                                <input type="hidden" name="_token" id="token" value="<?php echo csrf_token() ?>"/>

                                <input type="hidden" name="itemid" id="itemid"/>
                                <div class="modal-body">
                                    <div class="text-center">
                                        <div class="text-primary">
                                            <span class="modal-main-icon mdi mdi-info-outline"></span></div>
                                        <h3>Information!</h3>
                                        <p>Are you sure you want to remove this product from being featured?</p>
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
                <div id="confirmModal" tabindex="-1" role="dialog" class="modal fade in" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
                            </div>
                            <form id="uploadBulkForm">
                                <input type="hidden" name="_token" id="token" value="<?php echo csrf_token() ?>"/>

                                <input type="hidden" name="itemid" id="itemid"/>
                                <div class="modal-body">
                                    <div class="text-center">
                                        <div class="text-primary">
                                            <span class="modal-main-icon mdi mdi-info-outline"></span></div>
                                        <h3>Information!</h3>
                                        <p>Are you sure you want to upload these products for <strong><span id="categorytxt"></span> </strong>category?</p>
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




        </div>
        <script src="{{ asset('assets/lib/jquery/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/main.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/lib/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/lib/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/lib/jquery.nestable/jquery.nestable.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/lib/moment.js/min/moment.min.js')}}"  type="text/javascript"></script>
        <script src="{{ asset('assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/lib/daterangepicker/js/daterangepicker.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/lib/select2/js/select2.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/lib/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/lib/bootstrap-slider/js/bootstrap-slider.js')}}" type="text/javascript"></script>

        <script src="{{ asset('assets/lib/datatables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/lib/datatables/js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
<!--        <script src="{{ asset('assets/lib/datatables/plugins/buttons/js/dataTables.buttons.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/lib/datatables/plugins/buttons/js/buttons.html5.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/lib/datatables/plugins/buttons/js/buttons.flash.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/lib/datatables/plugins/buttons/js/buttons.print.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/lib/datatables/plugins/buttons/js/buttons.colVis.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/lib/datatables/plugins/buttons/js/buttons.bootstrap.js')}}" type="text/javascript"></script>
        -->

        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.bootstrap.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/buttons/1.4.2/js/buttons.colVis.min.js"></script>


        <script src="{{ asset('assets/lib/prettify/prettify.js')}}" type="text/javascript"></script>


        @yield('customjs')

        <script type="text/javascript">
$(document).ready(function () {
    //initialize the javascript
    App.init();
    App.formElements();
    App.dataTables();
    App.loaders();

    //Runs prettify
    prettyPrint();
});

function invoiceprint() {
    window.print();
}

function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}
        </script>   
    </body>
</html>
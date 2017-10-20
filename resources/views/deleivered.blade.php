@extends('layouts.forms')

@section('content')


<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">Delivered Orders</h2>
        <ol class="breadcrumb page-head-nav">
            <li><a href="#">Home</a></li>
            <li><a href="#">Orders</a></li>
            <li class="active">Delivered</li>
        </ol>
    </div>
    <div class="main-content container-fluid">




        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default table-responsive">

                    <div class="panel-body">
                        <table id="productTbl" class="table table-condensed table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>OrderNo</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Amount</th> 

                                    <th>Date Ordered</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>29202022</td>
                                    <td>Ama Ansah</td>
                                      <td>0205868690</td>
                                    <td>GHS 213.00</td>
                                   
                                    <td>2017-08-09 2:13:08</td>

                                    <td class="actions">
                                        <a href="#" class="icon"><i title="View" class="mdi mdi-eye"></i></a>

                                       
                                        <a href="#" class="icon"><i title="Delete" class="mdi mdi-delete"></i></a>
                                    </td>

                                </tr>

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
     
 var datatable = $('#productTbl').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'colvis']
        });
    });
</script>
@endsection


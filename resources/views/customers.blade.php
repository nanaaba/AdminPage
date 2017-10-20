@extends('layouts.master')

@section('content')


<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">Customers</h2>
        <ol class="breadcrumb page-head-nav">
            <li><a href="#">Home</a></li>
            <li><a href="#">Users</a></li>
            <li class="active">Customers</li>
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
                                    <th>Name</th> 
                                    <th>Contact</th> 
                                    <th>Email</th> 
                                    <th>Date Added</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Nana Aba</td>
                                    <td>0202020393</td>
                                    <td>abaodun@gmail.com</td>
                                    <td>2017-08-09 2:!3:08</td>

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
        var datatable = $('#productTbl').DataTable();

    });
</script>
@endsection


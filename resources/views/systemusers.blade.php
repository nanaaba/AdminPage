@extends('layouts.forms')

@section('content')


<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">System Users</h2>
        <ol class="breadcrumb page-head-nav">
            <li><a href="#">Home</a></li>

            <li class="active">System Users</li>
        </ol>
    </div>
    <div class="main-content container-fluid">



        <div class="row"  >
            <div class="col-lg-12">
                <div class="pull-right">
                    <button data-toggle="modal" data-target="#form-bp1" type="button" class="btn btn-space btn-primary">New User</button>
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
        var datatable = $('#categoryTbl').DataTable();

    });
</script>
@endsection


<!--Form Modals-->
<div id="form-bp1" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary">
    <div class="modal-dialog custom-width">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
                <h3 class="modal-title">New User</h3>
            </div>
            <form id="categoryForm">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="category_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Contact</label>
                        <input type="text" name="contact" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="select2 form-control" >
                            <option value="">Select---</option>
                        </select>
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

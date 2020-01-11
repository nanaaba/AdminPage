@extends('layouts.forms')

@section('content')


<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title"> Orders</h2>
        <ol class="breadcrumb page-head-nav">
            <li><a href="#">Home</a></li>

            <li class="active">Orders</li>
        </ol>
    </div>

    <div class="main-content container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default panel-border-color panel-border-color-primary">
                    <div class="panel-heading panel-heading-divider">
                        <div class="panel-body">
                            <form id="getOrderTypeForm">

                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <h4> Order Types</h4>
                                            <select class="select2" name="ordertype" id="ordertype">
                                                <option value="">Select --</option>
                                                <?php
                                                foreach ($statuses as $value) {
                                                    echo '    <option value="' . $value . '">' . $value . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="row xs-pt-15">
                                    <div class="col-xs-6">

                                    </div>
                                    <div class="col-xs-6">
                                        <p class="text-right">
                                            <button type="button" id="filterbtn" class="btn btn-block btn-space btn-primary">Filter</button>

                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>



        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">

                    <div class="panel-body ">
                        <table id="orderTbl" class="table-responsive table table-condensed table-hover table-bordered table-striped">
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

        var datatable = $('#orderTbl').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'colvis']
        });




        //filterbtn
        $('#filterbtn').click(function () {
            var ordertype = $('#ordertype').val();
            console.log(ordertype);
            getOrdersByStatus(ordertype);
        });

        function getOrdersByStatus(ordertype)
        {
            $('.loader').addClass('be-loading-active');


            $.ajax({
                url: 'getorders/' + ordertype,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('.loader').removeClass('be-loading-active');

                    var dataSet = data.data;
                    console.log(dataSet);
                    datatable.clear().draw();
                    console.log('size' + dataSet.length);
                    if (dataSet.length == 0) {
                        $('#infoModal').modal('show');

                        return;
                    } else {
                        $.each(dataSet, function (key, value) {




                            var j = -1;
                            var r = new Array();
                            // represent columns as array
                            r[++j] = '<td>' + value.orderID + '</td>';
                            r[++j] = '<td class="subject"> </td>';
                            r[++j] = '<td class="subject"></td>';
                            r[++j] = '<td > GHS ' + value.totalAmt.toFixed(2) + '</td>';
                            r[++j] = '<td class="subject">' + value.orderDate + '</td>';
                          r[++j] = '<td class="actions">' +
                                '<a  href="orderinformation/'+ value.orderID + '"  type="button" class="icon btn btn-outline-info btn-sm  col-sm-6 btn-edit editBtn" ><i title="View" class="mdi mdi-eye""></i><span class="hidden-md hidden-sm hidden-xs"> </span></a>' +
                                '<a  href="#" onclick="cancelOrder(' + value.orderID + ')" type="button" class="icon btn btn-outline-info btn-sm  col-sm-6 btn-edit editBtn" ><i title ="Delete" class="mdi mdi-delete""></i><span class="hidden-md hidden-sm hidden-xs"> </span></a>' +
                                '</td>';
                            // 
                            rowNode = datatable.row.add(r);
                        });
                        rowNode.draw().node();
                    }

                },
                error: function (jXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });

        }
    });

</script>
@endsection


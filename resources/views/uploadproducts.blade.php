@extends('layouts.forms')

@section('content')


<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title"> Product Bulk Upload</h2>
        <ol class="breadcrumb page-head-nav">
            <li><a href="#">Home</a></li>
            <li><a href="#">Products</a></li>
            <li class="active">Bulk Uploads</li>
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
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default panel-border-color panel-border-color-primary">
                    <div class="panel-heading panel-heading-divider">
                        <div class="panel-body">
                            <form id="uploadProductForm" enctype="multipart/form-data">

                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <h4>Category</h4>
                                            <select class="select2" name="category" id="category" required >
                                                <option value="">Select --</option>
                                                <?php
                                                foreach ($categories as $value) {
                                                    echo '    <option value="' . $value['categoryID'] . '">' . $value['name'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-sm-6">

                                        <div class="form-group">
                                            <h4>File</h4>

                                            <input type="file" name="productfile" id="file-1" class="form-control" required/>
                                            <label for="file-1" class="btn-default"> 
                                            </label>

                                        </div>
                                    </div>
                                </div>
                                <div class="row xs-pt-15">
                                    <div class="col-xs-6">

                                    </div>
                                    <div class="col-xs-6">
                                        <p class="text-right">
                                            <button type="submit" id="filterbtn" class="btn btn-block btn-space btn-primary">Upload</button>

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
                        <div class="table-responsive">
                            <table id="orderTbl" class=" table table-condensed table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Description</th>
                                        <th>Ingredients</th>
                                        <th>Quantity</th> 
                                        <th>Price</th>

                                    </tr>
                                </thead>
                                <tbody id="productTblbody">


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row xs-pt-15">
            <div class="col-xs-6">

            </div>
            <div class="col-xs-6" style="display: none" id="updloadproductdiv">
                <p class="text-right">
                    <button  id="uploadbtn" class="btn btn-block btn-space btn-primary">Upload Products</button>

                </p>
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
            buttons: ['copy', 'excel', 'pdf', 'colvis'],
            responsive: true
        });


        $('#uploadProductForm').on('submit', function (e) {

            e.preventDefault();
            var formData = new FormData($(this)[0]);
            console.log(formData);
            //  var formData = new FormData($(this)[0]);
//add class to div
            $('.loader').addClass('be-loading-active');
            $.ajax({
                url: "{{url('product/uploadbulkproducts')}}",
                type: "POST",
                data: formData,
                cache: false,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (data) {
                    $('.loader').removeClass('be-loading-active');
                    console.log('server data :' + data);

                    var dataSet = data;
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
                            r[++j] = '<td> <input type="text" name="product_names[]" class="form-control" value="' + value.product_name + '"/></td>';
                            r[++j] = '<td><textarea class="form-control descriptions">' + value.description + '</textarea></td>';
                            r[++j] = '<td><textarea class="form-control ingredients">' + value.ingredients + '</textarea></td>';
                            r[++j] = '<td><input type="text" name="quantity[]" class="quantities form-control" value="' + value.quantity + '"/> </td>';
                            r[++j] = '<td><input type="text" name="prices[]" class="prices form-control" value="' + value.price + '"/></td>';

                            // 
                            rowNode = datatable.row.add(r);
                        });
                        rowNode.draw().node();
                        $('#updloadproductdiv').show();
                    }

                }

            });
        });

    });

    $('#uploadbtn').click(function () {

        var category = $("#category :selected").text();

        $('#categorytxt').html(category);
        $('#confirmModal').modal('show');
    });


    $('#uploadBulkForm').on('submit', function (e) {

        e.preventDefault();
        var formData = new FormData($(this)[0]);
        console.log(formData);
        var token = $('#token').val();

        var TableData = JSON.stringify(storeProductsData());
        console.log('beneficiaries data:' + TableData);
        $('#confirmModal').modal('hide');

        $('.loader').addClass('be-loading-active');
        $.ajax({
            url: "{{url('product/savebulkproducts')}}",
            type: "POST",
            data: {_token: token, productdata: TableData},
            dataType: 'json',
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


    function storeProductsData()
    {
        var category = $('#category').val();
        var TableData = new Array();
        $('#productTblbody tr').each(function (row, tr) {
            TableData[row] = {
                "name": $(tr).find("td input").eq(0).val()
                , "description": $(tr).find('td:eq(1) .descriptions').val()
                , "ingredients": $(tr).find('td:eq(2) .ingredients').val()
                , "quantity": $(tr).find('td:eq(3) .quantities').val()
                , "price": $(tr).find('td:eq(4) .prices').val()
                , "categoryid": category

            }
            // TableData.push(TableData[row]);
        });

//        var TableData = [];
//  $("#productTblbody tr").each(function(i){
//    if(i==0) return;
//    var id = $.trim($(this).find("td input").eq(0).val());
//    var value1 = $.trim($(this).find("td").eq(1).text());
//    var value2 = $.trim($(this).find("td").eq(2).text());
//    TableData.push({id: id, value1: value1, value2: value2});
//  });

        // TableData.shift(); // first row will be empty - so remove
        return TableData;
    }
</script>
@endsection


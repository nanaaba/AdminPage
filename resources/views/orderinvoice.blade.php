@extends('layouts.forms')

@section('content')

<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">Order Invoice</h2>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Orders</a></li>
            <li class="active">Order Detail</li>
        </ol>
    </div>


    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div id="printableArea">
                    <div class="invoice">

                        <div class="row invoice-header">
                            <div class="col-xs-7">
                                <div class="invoice-logo"></div>
                            </div>
                            <div class="col-xs-5 invoice-order"><span class="invoice-id">Invoice #{{$orderinfo['orderID']}}</span>
                                <br>
                                <span class="incoice-date">Ordered Date: {{$orderinfo['orderDate']}}</span></div>
                        </div>
                        <div class="row invoice-data">
                            <div class="col-xs-5 invoice-person"><span class="name">Nana Aba</span>
                                <span class="phone">+233 269299292</span>
                                <?php
                                $address = $orderinfo['shippingAddress'];
                                if ($address != null) {
                                    echo ' <span>' . $address['name'] . '</span>';
                                    echo ' <span>' . $address['description'] . '</span>';
                                    echo ' <span>' . $address['location'] . '</span>';
                                }
                                ?>
                            </div>
                            <div class="col-xs-2 invoice-payment-direction"></div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class=" table ">
                                    <tr>
                                        <th class="img-responsive">Url</th>
                                        <th class="description">Item</th>
                                        <th  class="amount">Quantity</th>
                                        <th  class="amount">UnitPrice(GHS)</th>
                                        <th  class="amount">Item Total(GHS)</th>
                                    </tr>


                                    <?php
                                    foreach ($orderinfo['items'] as $value) {
                                        echo '  <tr>
                                       <td class="text-center">
                                            <img class="img-thumbnail img-responsive" style="height:50px;width:50px;" src="http://tfs.knust.edu.gh/ecommerce/images/' . $value['iconUrl'] . '"></td>
                                    <td class="descriptiion">' . $value['name'] . '</td>
                                    <td >' . $value['quantity'] . '</td>
                                    <td class="amount">' .round($value['promoPrice'],2) . '</td>
                                    <td class="amount">' . round($value['itemTotal'],2) . '</td>
                                </tr>';
                                    }
                                    ?>

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="summary">Subtotal</td>
                                        <td class="amount">GHS {{$orderinfo['totalAmt']}}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="summary">Charges</td>
                                        <td class="amount">GHS {{$orderinfo['charges']}}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="summary total">Total</td>
                                        <td class="amount total-value">GHS {{$orderinfo['totalAmt']}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 invoice-payment-method"><span class="title">Payment Method</span>
                                <span>{{$orderinfo['paymentMode']}}</span>
                            </div>
                        </div>
                        <div class="row text-center" >
                            <div class="col-md-12 invoice-message"><span class="title">Thank you for shopping with koala</span>
                                <p>We are at your service</p>
                            </div>
                        </div>
<!--                        <div class="row invoice-company-info">
                            <div class="col-sm-6 col-md-2 logo"><img src="assets/img/logo-symbol.png" alt="Logo-symbol"></div>
                            <div class="col-sm-6 col-md-4 summary"><span class="title">Koala</span>
                            </div>
                            <div class="col-sm-6 col-md-3 phone">
                                <ul class="list-unstyled">
                                    <li>0261512300</li>

                                </ul>
                            </div>
                            <div class="col-sm-6 col-md-3 email">
                                <ul class="list-unstyled">
                                    <li>info@koala.com.gh</li>

                                </ul>
                            </div>
                        </div>-->

                        <div class="row invoice-footer">
                            <div class="col-md-12">

                                <button class="btn btn-lg btn-space btn-default" onclick="printDiv('printableArea')">Print</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
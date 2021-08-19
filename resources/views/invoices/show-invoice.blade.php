
@extends('layouts.app', ['page' => __('Show Invoice'), 'pageSlug' => 'invoices-show'])
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div id="printableArea">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6" style="display: inline-block;width: 64%">

                                <span class="btn-simple btn-success btn-sm rounded-0 m-r-15 p-10">Invoice From:</span>
                                <address style="margin-top:10px">
                                    <strong>Tech Lab</strong><br>
                                    Uttara<br>
                                    <abbr><b>Mobile:</b></abbr> 01710000661<br>
                                    <abbr><b>Email:</b></abbr>
                                    tlb2021@gmail.com<br>
                                    <abbr><b>Website:</b></abbr>
                                    https://www.tl.com
                                </address>
                            </div>
                            <div class="col-md-6 text-left" style="display: inline-block;">

                                <span class="label label-success-outline m-r-15">Invoice To:</span>
                                <br><br>
                                <div><strong>Sell No </strong>: 1914</div>
                                <div class="m-b-15"><strong>Billing Date </strong>: 2021 - AUG - 15</div>
                                <address style="margin-top:10px;width: 200px">
                                    <strong>walking customer </strong><br>
                                </address>
                            </div>
                        </div> <hr>
                        <div class="table-responsive m-b-20">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th align="center">SL.</th>
                                    <th align="left">Product Name</th>
                                    <th style="text-align: center;">Carton</th>
                                    <th style="text-align: center;">Quantity/Box</th>
                                    <th style="text-align: center;">Total Quantity</th>
                                    <th style="text-align: center;">Discount/Pcs.</th>
                                    <th style="text-align: right;">Rate</th>
                                    <th style="text-align: right;">Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td align="">1</td>
                                    <td align=""><div><strong>hp - (pavillion)</strong></div></td>
                                    <td align="center">1</td>
                                    <td align="center">10</td>
                                    <td align="center">10</td>
                                    <td align="center">$ 0</td>
                                    <td style="text-align: right;">$ 50000</td>
                                    <td style="text-align: right;">$ 500000</td>
                                </tr>
                                <tr>
                                    <td align="">2</td>
                                    <td align=""><div><strong>PHP - (502)</strong></div></td>
                                    <td align="center">6</td>
                                    <td align="center">5</td>
                                    <td align="center">30</td>
                                    <td align="center">$ 0</td>
                                    <td style="text-align: right;">$ 50</td>
                                    <td style="text-align: right;">$ 1500</td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr><td align="center" colspan="2" style="border: 0px"><b>Grand Total:</b></td>
                                    <td align="center" style="border: 0px"><b>7</b></td>
                                    <td style="border: 0px"></td>
                                    <td align="center" style="border: 0px"><b>40</b></td>
                                    <td style="border: 0px"></td>
                                    <td style="border: 0px"></td>
                                    <td style="text-align: right;"><b>$ 501,500.00</b></td>
                                </tr></tfoot>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-xs-8" style="display: inline-block;width: 66%">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                <p><strong>Thank you very much for choosing us.</strong></p>
                            </div>
                            <div class="col-xs-4" style="display: inline-block;">
                                <table class="table">
                                    <tbody><tr style="text-align: right;">
                                        <th class="grand_total">Grand Total :</th>
                                        <td class="grand_total">$ 501,500.00</td>
                                    </tr>
                                    <tr style="text-align: right;">
                                        <th style="border-top: 0; border-bottom: 0;">Paid Amount : </th>
                                        <td style="border-top: 0; border-bottom: 0;">$ 400.00</td>
                                    </tr>
                                    <tr style="text-align: right;">
                                        <th>Due : </th>
                                        <td>$ 501,100.00</td>
                                    </tr>
                                    </tbody></table>
                                <div style="float:left;width:90%;text-align:center;border-top:1px solid #e4e5e7;margin-top: 100px;font-weight: bold;">
                                    Authorised By </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-left">
                    <a class="btn btn-danger" href="#">Cancel</a>
                    <button class="btn btn-info" onclick="if (!window.__cfRLUnblockHandlers) return false; printDiv('printableArea')"><span class="fa fa-print"></span></button>
                    <a class="btn btn-success" href="#"><i class="fa fa-download"> </i></a>
                </div>
            </div>
        </div>
    </div>
@endsection

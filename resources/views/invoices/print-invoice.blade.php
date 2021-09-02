<!DOCTYPE html>
<html lang="">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PDF</title>
    <!-- Favicon -->

    <!-- Argon CSS -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
    <style type="text/css" media="all">
        html {
            font-size: 18px;
            line-height: 15px !important;
            /*font-family: "Open Sans", serif;*/
            font-weight: 300;
        }
    </style>
</head>

<body>

<div class="container-fluid bg-white text-dark">


    <br>
    <br>
    <br>
    <br>
    <!--                                Invoice From and To-->

    <table class="table-borderless" style="width: 100%">
        <tr>
            <td style="width: 50%;vertical-align: top ">
                <div class="text-left">
                    @if($invoice->company)
                        <div class="mb-3">
                            <span
                                class="text-success border border-success pl-2 pt-1 pb-1 pr-2"><strong>Invoice From:</strong></span>
                            <address class="mt-3">
                                @if($invoice->company->company_name)
                                    <div>
                                        <strong>{{$invoice->company->company_name}}</strong><br>
                                    </div>
                                @endif
                                @if($invoice->company->company_address)
                                    <div>
                                        {{$invoice->company->company_address}}
                                    </div>
                                @endif
                                @if($invoice->company->company_contact)
                                    <div>
                                        <abbr><b>Mobile: </b></abbr> {{$invoice->company->company_contact}}
                                    </div>
                                @endif
                                @if($invoice->company->company_email)
                                    <div>
                                        <abbr><b>Email: </b></abbr>{{$invoice->company->company_email}}
                                    </div>
                                @endif
                                @if($invoice->company->company_website)
                                    <div>
                                        <abbr><b>Website: </b></abbr>{{$invoice->company->company_website}}
                                    </div>
                                @endif
                            </address>
                        </div>
                    @endif

{{--                    Subject, Driver and Vehicle info--}}

                    <div>
                        <b>Subject: </b>{{ $invoice->subject}}
                    </div>
                    @if($invoice->driver)
                        <div>
                            <b>Driver: </b>{{ $invoice->driver->name}} -- {{$invoice->driver->contact}}
                        </div>
                    @endif
                    @if($invoice->car_details)
                        <div>
                            <b>Vehicle: </b>{{ $invoice->car_details}}
                        </div>
                    @endif


                </div>
            </td>
            <td style="width: 50%; vertical-align: top">
                <div class="text-right">
                    @if($invoice->client)
                        <div class="mb-3">
                            <span class="text-success text-right border border-success pl-2 pt-1 pb-1 pr-2"><strong>Invoice To:</strong></span>
                            <address class="mt-3 d-block">
                                @if($invoice->client->client_name)
                                    <div>
                                        <strong>{{$invoice->client->client_name}}</strong><br>
                                    </div>
                                @endif
                                @if($invoice->client->client_address)
                                    <div>
                                        {{$invoice->client->client_address}}
                                    </div>
                                @endif
                                @if($invoice->client->client_contact)
                                    <div>
                                        <abbr><b>Mobile: </b></abbr> {{$invoice->client->client_contact}}
                                    </div>
                                @endif
                                @if($invoice->client->client_email)
                                    <div>
                                        <abbr><b>Email: </b></abbr>{{$invoice->client->client_email}}
                                    </div>
                                @endif
                                @if($invoice->client->client_website)
                                    <div>
                                        <abbr><b>Website: </b></abbr>{{$invoice->client->client_website}}
                                    </div>
                                @endif
                            </address>
                        </div>
                @endif

                <!--                                    Invoice Date and ID-->

                    <div><strong>Invoice Date: </strong>{{$invoice->date}}</div>
                    <div><strong>Invoice No: </strong>{{$invoice->invoice_number}}</div>


                </div>
            </td>
        </tr>
    </table>

    <!--                            Items Table-->

    <br>

    <div class="row pt-0">
        <div class="col">
            <table class="table table-borderless table-striped table-sm">
                <tr>
                    <th class="text-left">SL</th>
                    <th class="text-left">Description</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Unit</th>
                    <th class="text-right">Rate</th>
                    <th class="text-right">Amount</th>
                </tr>

                @foreach($invoice->items as $index=>$item)
                    <tr>
                        <td class="text-left">{{$index+1}}</td>
                        <td style="max-width: 300px; white-space:pre-wrap; word-wrap:break-word"
                            class="text-left text-dark">{{$item->description? $item->description : '-'}}</td>
                        <td class="text-center">{{$item->quantity? $item->quantity : '-'}}</td>
                        <td class="text-center">{{$item->unit? $item->unit : '-'}}</td>
                        <td class="text-right">{{$item->rate? sprintf('%0.2f',$item->rate) : '-'}}</td>
                        <td class="text-right">{{$item->amount? sprintf('%0.2f',$item->amount) : '-'}}</td>
                    </tr>
                @endforeach

            </table>
        </div>
    </div>

    <!--                                    Amounts-->

    <table class="table-sm" style="width: 100%; font-size: 18px;">
        <tr>
            <td style="width: 60%; vertical-align: top">
                <div class="text-left border-top pt-1">
                    <span><strong>In Words:</strong> {{" 000 Taka Only"}}</span>
                    <br>
                    <p><strong>Thank you very much for choosing us.</strong></p>

                    <small style="font-size: 12px">"{{$invoice->invoice_signature}}"<br> - This Invoice is auto
                        generated, thus requires no sign.</small>
                </div>
            </td>
            <td style="width: 40%; vertical-align: top" class="text-right">
                <table class="table table-sm float-right">
                    <tr class="text-right">
                        <th>Total:</th>
                        <td>{{'BDT '}}{{sprintf('%0.2f',$invoice->sub_total)}}</td>
                    </tr>
                    @if($invoice->tax)
                        <tr class="text-right">
                            <th class="border-0">TAX: {{'@ '. $invoice->tax. '%'}}</th>
                            <td class="border-0">{{'BDT '}}{{sprintf('%0.2f', (($invoice->tax/100)*$invoice->sub_total))}}
                            </td>
                        </tr>
                    @endif
                    @if($invoice->vat)
                        <tr class="text-right">
                            <th class="border-0">VAT: {{'@ ' . $invoice->vat. '%'}}</th>
                            <td class="border-0">{{'BDT '}}{{sprintf('%0.2f',(($invoice->vat/100)*$invoice->sub_total))}}
                            </td>
                        </tr>
                    @endif
                    @if(($invoice->discount || $invoice->advance_paid) && ($invoice->vat || $invoice->tax))
                        <tr class="text-right">
                            <th>Net Amount:</th>
                            <td>{{'BDT '}}{{sprintf('%0.2f', $invoice->net_amount)}}</td>
                        </tr>
                    @endif
                    @if($invoice->discount)
                        <tr class="text-right">
                            <th class="border-0">Discount:</th>
                            <td class="border-0">{{'BDT '}}{{sprintf('%0.2f', $invoice->discount)}}</td>
                        </tr>
                    @endif
                    @if($invoice->advance_paid)
                        <tr class="text-right">
                            <th class="border-0">Advance Paid:</th>
                            <td class="border-0">{{'BDT '}}{{sprintf('%0.2f', $invoice->advance_paid)}}</td>
                        </tr>
                    @endif
                    <tr class="text-right">
                        <th>Payable:</th>
                        <td>{{'BDT '}}{{sprintf('%0.2f',($invoice->net_amount-$invoice->discount-$invoice->advance_paid))}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</div>
</body>
</html>


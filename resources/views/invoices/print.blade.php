@extends('layouts.app') @section('title') {{ $invoice_info->invoice_id }} @endsection @section('header-script')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('back/css/print.css') }}">
<style>
    .clearfix:after {
        content: "";
        display: table;
        clear: both;
    }

    a {
        color: #0087C3;
        text-decoration: none;
    }

    body {
        position: relative;
        margin: 0 auto;
        color: #555555 !important;
        background: #FFFFFF;
        font-family: Arial, sans-serif;
        font-size: 12px;
        font-family: SourceSansPro;
    }

    header {
        padding: 10px 0;
        margin-bottom: 15px;
        border-bottom: 1px solid #AAAAAA;
    }

    #logo {
        float: left;
        margin-top: 6px;
    }

    #logo img {
        height: 150px;
    }

    #company {
        float: right;
        text-align: right;
    }

    #details {
        margin-bottom: 50px;
    }

    #client {
        padding-left: 6px;
        border-left: 6px solid #0087C3;
        float: left;
    }

    #client .to {
        color: #777777;
    }

    h2.name {
        font-size: 15px;
        font-weight: normal;
        margin: 0;
        font-weight: bold;
    }

    #invoice {
        float: right;
        text-align: right;
    }

    #invoice h1 {
        color: #0087C3;
        font-size: 13px;
        line-height: 1em;
        font-weight: normal;
        margin: 0 0 10px 0;
    }

    #invoice .date {
        font-size: 12px;
        color: #777777;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        border: 1px solid black;
        ;
        margin-bottom: 20px;
    }

    table th,
    table td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 5px;
        background: #EEEEEE ;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
    }

    table th {
        border: 1px solid black;
        border-collapse: collapse;
        white-space: nowrap;
        font-weight: normal;
    }

    table td {
        border: 1px solid black;
        border-collapse: collapse;
        text-align: right;
    }

    table td h3 {
        border: 1px solid black;
        border-collapse: collapse;
        color: #57B223;
        font-size: 1.2em;
        font-weight: normal;
        margin: 0 0 0.2em 0;
    }

    table .no {
        color: #FFFFFF;
        font-size: 12px;
        background: #57B223 !important;
        -webkit-print-color-adjust: exact;
    }

    table .desc {
        text-align: left;

    }

    table .unit {
        background: #DDDDDD !important;
        -webkit-print-color-adjust: exact;
    }

    table .qty {}

    table .total {
        background: #57B223 !important;
        -webkit-print-color-adjust: exact;
        color: #FFFFFF;
    }

    table td.unit,
    table td.qty,
    table td.total {
        font-size: 1.2em;
    }

    table tbody tr:last-child td {
        border: none;
    }

    table tfoot td {
        padding: 10px 20px;
        background: #FFFFFF;
        border-bottom: none;
        font-size: 1.2em;
        white-space: nowrap;
        border-top: 1px solid #AAAAAA;
    }

    table tfoot tr:first-child td {
        border-top: none;
    }

    table tfoot tr:last-child td {
        color: #57B223;
        font-size: 1.4em;
        border-top: 1px solid #57B223;
    }

    table tfoot tr td:first-child {
        border: none;
    }

    #thanks {
        font-size: 2em;
        margin-bottom: 50px;
    }

    #notices {
        padding-left: 6px;
        border-left: 6px solid #0087C3;
    }

    #notices .notice {
        font-size: 1.2em;
    }

    footer {
        color: #777777;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #AAAAAA;
        padding: 8px 0;
        text-align: center;
    }
</style>
@endsection @section('content')
<div id="page-wrapper">
    <div class="main-page">
        @include('layouts.include.alert')
        <div class="container">

            <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                <div class="form-title">

                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">
                            <div id="printcontent" style="padding: 8px; margin-top:5px;">
                                <header class="clearfix">
                                    <div id="logo">
                                        <img src="{{ asset($company->logo) }}">
                                    </div>
                                    <div id="company">
                                        <h3 class="name"><b>{{ $company->name }}</b> </h3>
                                        <div ><font size="3">Didar Nibash . 83 / 2 Muradpur High School Road . <br>Jurain . Kadomtoli . Dhaka - 1204 . E - BIN :001437901-0308</font></div>
                                        <div><font size="3">{{ $company->mobile}}</font></div>
                                        <div><a href="#"><font size="3">{{$company->email }}</font></a></div>
                                    </div>

                                </header>
                                <main>
                                    <div id="details" class="clearfix">
                                        <div id="client">
                                            <div class="to"><b>INVOICE TO:</b></div>
                                            <h2 class="name">{{ $customer_info->name }}</h2>
                                            <div class="address"><font size="3">{{ $customer_info->address }}</font></div>
                                            <div class="email"><a href="#"><font size="3">{{ $customer_info->primary_mobile }}</font></a></div>
                                        </div>
                                        <div id="invoice">
                                            <h2>INVOICE : {{ $invoice_info->invoice_id }}</h2>
                                            <div class="date"><font size="3">Date of Invoice: {{ Carbon\Carbon::parse($invoice_info->manual_date)->format('d-m-Y') }}</font></div>
                                        </div>
                                    </div>
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <thead>
                                            <tr>
                                                <th class="no">SL.</th>
                                                <th class="unit"><b>Description</b></th>
                                                <th class="total">Size</th>
                                                <th>Quantity</th>
                                                <th class="total" >Unit</th>
                                                <th>Price</th>
                                                <th class="total"><b>Total Price</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($product_info as $item)
                                            <tr>
                                                <td style="width: 1%;" class="no">{{ $loop->iteration }}</td>
                                                <td style="width: 40%;" class="unit" >{{ $item->name }}</td>
                                                <td class="total" style="width: 10%;">{{ $item->size }}</td>
                                                <td class="qty" style="width: 7%;">{{ $item->quantity }}</td>
                                                <td style="width: 8%;" class="total" >
                                                    @if(isset($units[$item->unit_id])) {{ $units[$item->unit_id] }} @endif
                                                </td>
                                                <td style="width: 8%;">{{ $item->sale_price }}</td>
                                                <td class="total" style="width: 11%;" ><b>{{ $item->sale_price*$item->quantity }}</b></td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="3" style="text-align: right;">Total </td>
                                                <td>{{ $product_info->sum('quantity') }}</td>
                                                <td></td>
                                                <td></td>
                                                <td><b>{{ $total_price }}</b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" style="text-align: right;"><b>Discount Amount</b></td>
                                                <td><b>{{ $total_discount }}</b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" style="text-align: right;"><b>Advanced Amount</b></td>
                                                <td><b>{{ $invoice_info->advanced }}</b></td>
                                            </tr>

                                            <tr>
                                                <td colspan="6" style="text-align: right;"><b>Due Amount</b></td>
                                                <td><b>{{ $invoice_info->due_amount }}</b></td>
                                            </tr>

                                            <tr id="preview-due">
                                                <td colspan="6" style="text-align: right;"><b>Total Due Amount</b></td>
                                                <td><b>{{ $total_due }}</b></td>
                                            </tr>

                                        </tbody>

                                    </table>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="text-center">
                                                <b>In Words: {{ strtoupper(Terbilang::make($invoice_info->grand_total_price, ' Taka Only')) }}</b>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 quote">
                                            <p class="text-center">
                                                {{ $company->quote }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="customers_sign">
                                                <hr style="border: 1px solid black;" />
                                                <h4>Customers Signature</h4>
                                                <h4></h4>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="owners_sign">
                                                <hr style="border: 1px solid black;" />
                                                <h4>Oweners Signature</h4>
                                            </div>
                                        </div>
                                    </div>
                                </main>
                            </div>
                            <div class="btn-section">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary btn-block" onclick="printDiv('printcontent');"><i class="fa fa-print"></i> Print</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ url('/invoice-sms/'.$invoice_info->id) }}" class=" btn btn-sm btn-success btn-block">
                                            <i class="fa fa-paper-plane"></i> Sent sms
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary show_due btn-block"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--<div class="form-grids row widget-shadow" data-example-id="basic-forms">
                <div class="form-title">

                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">
                          <div id="printcontent" style="padding: 5px; margin-top:5px;">

                              <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                  <div class="logo">
                                    <img src="{{ asset($company->logo) }}" alt="">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                  <div class="company_info">
                                    <p id="company_name">{{ $company->name }} </p>
                                    <p id="company_address">{{ $company->address }}</p>
                                    <p id="company_mobile_email">{{ $company->mobile.' '.$company->email }}</p>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-4 col-xs-3">
                                  <div class="form-group">
                                    <label class="control-label col-sm-6" for="email">Invoice:</label>
                                    <div class="col-sm-5">
                                     {{ $invoice_info->invoice_id }}
                                    </div>
                                 </div>

                            </div>
                                <div class="col-md-2 col-xs-3">

                                </div>
                                <div class="col-md-3 col-xs-3">

                                </div>
                                <div class="col-md-3 col-xs-3">
                                     <label class="control-label col-sm-3" for="email">Date:</label>
                                    <div class="col-sm-9">
                                        {{ Carbon\Carbon::parse($invoice_info->manual_date)->format('d-m-Y') }}
                                    </div>

                                  </div>
                                  {{-- <p>Date<input type="date" class="form-control" value="{{ Carbon\carbon::now()->format("d-m-Y") }}"></p> --}}
                                </div>

                              <table class="table table-bordered print-table">
                                <tbody>
                                  <tr>
                                    <td style="width: 10px;">Name</td>
                                    <td>{{ $customer_info->name }}</td>
                                  </tr>
                                  <tr>
                                    <td style="width: 10px;">Address</td>
                                    <td>{{ $customer_info->address }}</td>
                                  </tr>
                                  <tr>
                                    <td style="width: 10px;">Mobile</td>
                                    <td>{{ $customer_info->primary_mobile }}</td>
                                  </tr>
                                </tbody>
                              </table>

                              <table class="table table-bordered print-table">
                                <thead>
                                  <tr>
                                    <th>SL.</th>
                                    <th>Description</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Unit</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($product_info as $item)
                                    <tr>
                                      <td style="width: 1%;">{{ $loop->iteration }}</td>
                                      <td>{{ $item->name }}</td>
                                      <td>{{ $item->size }}</td>
                                      <td>{{ $item->sale_price }}</td>
                                      <td>
                                          @if(isset($units[$item->unit_id]))
                                            {{ $units[$item->unit_id] }}
                                          @endif
                                      </td>
                                      <td>{{ $item->quantity }}</td>
                                      <td>{{ $item->sale_price*$item->quantity }}</td>
                                    </tr>
                                  @endforeach
                                  <tr>
                                    <td colspan="5" style="text-align: right;">Total </td>
                                    <td>{{ $product_info->sum('quantity') }}</td>
                                    <td>{{ $total_price }}</td>
                                  </tr>
                                  <tr>
                                    <td colspan="6" style="text-align: right;">Discount Amount</td>
                                    <td>{{ $total_discount }}</td>
                                  </tr>
                                  <tr>
                                    <td colspan="6" style="text-align: right;">Advanced Amount</td>
                                    <td>{{ $invoice_info->advanced }}</td>
                                  </tr>

                                  <tr>
                                    <td colspan="6" style="text-align: right;">Due Amount</td>
                                    <td>{{ $invoice_info->due_amount }}</td>
                                  </tr>

                                  <tr id="preview-due">
                                    <td colspan="6" style="text-align: right;">Total Due Amount</td>
                                    <td>{{ $total_due }}</td>
                                  </tr>

                                </tbody>
                              </table>

                              <div class="row">
                                <div class="col-md-12">
                                  <p class="text-center">
                                    In Words:  {{ strtoupper(Terbilang::make($invoice_info->grand_total_price, ' Taka Only')) }}
                                  </p>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-12 quote">
                                  <p class="text-center">
                                    {{ $company->quote }}
                                  </p>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-6">
                                  <div class="customers_sign">
                                       <hr style="border: 1px solid black;"/>
                                      <h4>Customers Signature</h4>
                                      <h4></h4>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="owners_sign">
                                      <hr style="border: 1px solid black;"/>
                                      <h4>Oweners Signature</h4>
                                  </div>
                                </div>
                              </div>

                              <footer id="footer">
                                powered by it-solutionsbd.com
                              </footer>

                          </div>

                          <div class="btn-section">
                            <div class="row">
                              <div class="col-md-12">
                                <button type="button" class="btn btn-primary btn-block" onclick="printDiv('printcontent');"><i class="fa fa-print"></i> Print</button>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <a href="{{ url('/invoice-sms/'.$invoice_info->id) }}" class=" btn btn-sm btn-success btn-block">
                                  <i class="fa fa-paper-plane"></i> Sent sms
                                </a>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <button type="button" class="btn btn-primary show_due btn-block"><i class="fa fa-plus"></i></button>
                              </div>
                            </div>
                          </div>

                        </div>
                    </div>
                </div>
            </div>-->

@endsection @section('footer-script')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js"></script>
<script>
    $('.input-group.date').datepicker({
        format: "dd.mm.yyyy"
    });

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;

        window.location.href = "{{ url()->current() }}";
    }

    $("#preview-due").hide();
    $(".show_due").click(function() {
        $("#preview-due").toggle(500);
    });
</script>
@endsection

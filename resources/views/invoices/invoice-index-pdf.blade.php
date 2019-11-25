@extends('layouts.app')
@section('title')
Invoice List
@endsection
@section('header-script')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('back/css/print.css') }}">
  <style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
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
        width: 32cm;
        color: #555555;
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
        height: 100px;
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
        background: #EEEEEE;
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
        background: #57B223;
    }
    
    table .desc {
        text-align: left;
    }
    
    table .unit {
        background: #DDDDDD;
    }
    
    table .qty {}
    
    table .total {
        background: #57B223;
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

@endsection
@section('content')
<div id="page-wrapper">
    <div class="main-page">
        <div class="forms">
            <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                <div class="form-title">
                    
                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">
                          <div id="printcontent" style=" overflow: hidden;">
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


                              <div class="row">
                                <div class="col-md-3 col-xs-3">
                                  
                                </div>
                                <div class="col-md-3 col-xs-3">
                                  
                                </div>
                                <div class="col-md-3 col-xs-3">
                                  
                                </div>
                                <div class="col-md-3 col-xs-3">
                                  
                                  <div class="input-group date" data-date-format="dd.mm.yyyy">
                                    Date<input  type="text" class="form-control" placeholder="dd.mm.yyyy" value="{{ Carbon\Carbon::now()->format('d.m.Y') }}">
                                    <div class="input-group-addon" >
                                      <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                  </div>
                                  
                                </div>
                              </div>
                              
                                <table class="table table-bordered">
                                  <thead>
                                      <tr>
                                          <th class="no">SL</th>
                                          <th>Invoice</th>
                                          <th class="no">Amount</th>
                                          <th>Date</th>
                                          <th class="no">Customer</th>
                                          <th>Address</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($invoices as $item)
                                      <tr >
                                          <td class="no" style="width: 1%;">{{ $loop->iteration }}</td>
                                          <td style="width: 1%;">
                                              <a href="{{ url('/invoices/' . $item->id) }}" style="cursor: pointer;">
                                                  {{ $item->invoice_id }}
                                              </a>
                                              
                                          </td>
                                          <td class="no" style="width: 10%;">{{ $item->grand_total_price }}</td>
                                          <td style="width: 11%; word-break: break-all;">
                                              {{ $item->manual_date }}
                                          </td>
                                          <td class="no" style="width: 25%;">
                                              @if(isset($customer_name[$item->customer_id]))
                                                  {{ $customer_name[$item->customer_id] }}
                                              @endif
                                          </td>
                                          <td >
                                              @if(isset($customer_address[$item->customer_id]))
                                                  {{ $customer_address[$item->customer_id] }}
                                              @endif
                                          </td>
                                          
                                      </tr>
                                  @endforeach
                                  <tr>
                                      <td colspan="2" style="text-align: right;">Total</td>
                                      <td style="text-align: right;">{{ $invoices->sum('grand_total_price') }}</td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                  </tr>
                                  </tbody>
                              </table>

                              <div class="row">
                                <div class="col-md-12">
                                  <p class="text-center">
                                    In Words:  {{ strtoupper(Terbilang::make($invoices->sum('grand_total_price'), ' Taka Only')) }}
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
                          <div class="row">
                            <div class="col-md-12">
                              <button type="button" class="btn btn-primary print_btn btn-block" onclick="printDiv('printcontent');"><i class="fa fa-print"></i> Print</button>
                            </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
</div>
@endsection
@section('footer-script')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js"></script>
<script>
   $('.input-group.date').datepicker({format: "dd.mm.yyyy"}); 

   function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;

     window.location.href = "{{ url()->current() }}";
}

$("#preview-due").hide();
$(".show_due").click(function(){
  $("#preview-due").toggle(500);
});
</script>
@endsection

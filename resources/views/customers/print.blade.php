@extends('layouts.app')
@section('title')
Customer Ledger {{ $customer->name }}
@endsection
@section('header-script')
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
                          <div id="printcontent" style="padding: 5px;">
                             <header class="clearfix">
                                    <div id="logo">
                                        <img src="{{ asset($company->logo) }}">
                                    </div>
                                    <div id="company">
                                        <h2 class="name">{{ $company->name }} </h2>
                                        <div>Didar Nibash . 83 / 2 Muradpur High School Road . <br>Jurain . Kadomtoli . Dhaka - 1204 . E - BIN : 001437901-0308</div>
                                        <div>{{ $company->mobile }}</div>
                                        <div><a href="#">{{$company->email }}</a></div>
                                    </div>

                                </header>
                                <main>
                                    <div id="details" class="clearfix">
                                        <div id="client">
                                            <div class="to">Ladger To:</div>
                                            <h2 class="name">{{ $customer->name }}</h2>
                                            <div class="address">{{ $customer->address }}</div>
                                            <div class="email"><a href="#">{{ $customer->primary_mobile }}</a></div>
                                        </div>
                                        <div id="invoice">
                                           
                                            <div class="date">Date: {{ Carbon\Carbon::now()->format('d.m.Y') }}</div>
                                        </div>
                                    </div>

                         





                              <table border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                  <tr>
                                      <th>SL.</th>
                                      <th>Date</th>
                                      <th>Invoice</th>
                                      <th>Quantity</th>
                                      <th>Invoice Amount</th>
                                      <th>Recived Amount</th>
                                     {{-- <th>Due Amount</th> --}}
                                      <th>Balance</th>
                                      <th>Notebar</th>
                                      <th>Receipt By</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                        $gtotal = 0;
                                        $pgtotal = 0;
                                        $sgtotal = 0
                                    @endphp
                                    @if(isset($results)) 
                                        @foreach($results as $key2 => $item)
                                        @php
                                        $gtotal = $gtotal;
                                        @endphp
                                        <tr>
                                            <td style="width: 1%;"> {{$key2+1}}
                                            </td>
                                            <td style="width: 11%;"> 
                                                {{ Carbon\Carbon::parse($item['created_at'])->format('d-m-Y') }}
                                            </td>
                                            <td> 
                                                @if($item['ivno'])
                                                    <a href="{{ url('/invoices-print/'.$item['ivno'] ) }}" style="cursor: pointer;"> {{ $item['ivno'] }}</a>
                                                @endif </td>
                                            <td style="width: 10%;">{{ $item['qty'] }}</td>
                                            <td style="width: 14%;">{{ $item['amount'] }}</td>
                                            <td style="width: 15%;">{{ $item['ramount'] }}</td>
                                            {{-- <td style="width: 12%;">{{ $item['damount'] }}</td> --}}
                                            @php
                                             
                                            if($item['type'] == 'payments'){
                                             $sgtotal = $sgtotal + $item['lamount'];
                                            }
                                            if(($item['type'] == 'customer') || ($item['type'] == 'invoice') ){
                                             $pgtotal = $pgtotal + $item['lamount'];
                                            }
                                            $gtotal = $pgtotal - $sgtotal;
                                            @endphp
                                            <td style="width: 12%;">{{$gtotal}}</td>
                                            <td>{{ $item['notebar'] }}</td>
                                            @php
                                                $user = App\User::where('id',$item['user_id'])->first();
                                            @endphp
                                            @if($item['user_id'])
                                            <td style="width: 10%;">{{$user->name}} </td>
                                            @else 
                                            <td style="width: 10%;"> </td>
                                            @endif
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                        @endforeach 
                                    @endif
                                    @if(isset($invoices))
                                         
                                        <?php
                                          $grand_total_price = $invoices->sum('grand_total_price');
                                          $advanced_amount = $invoices->sum('advanced');
                                          $total_advanced_amount = $advanced_amount+$total_payment_amount;
                                          $due_amount = $grand_total_price+$customer->due-$total_advanced_amount;
                                          $quantity = $invoices->sum('total_quantity');
                                          if($customer->quantity != null){
                                            $total_quantity = $quantity+$customer->quantity;
                                          }else{
                                            $total_quantity = $invoices->sum('total_quantity');
                                          }
                                          
                                        ?>
                                        <tr>
                                            <td colspan="3" class="text-right">Total</td>
                                            <td>{{ $total_quantity }}</td>
                                            <td>{{ $grand_total_price }}</td>
                                            <td>{{ $total_advanced_amount }}</td>
                                            <td>{{ $due_amount }}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endif 
                                </tbody>
                              </table>


                              <div class="row">
                                <div class="col-md-12 quote">
                                  <p class="text-center">
                                    
                                  </p>
                                </div>
                              </div>


                              <div class="row">
                                <div class="col-md-6">
                                  <div class="customers_sign">
                                       <hr style="border: 1px solid black;"/>
                                      <h4>Oweners Signature</h4>
                                      <h4></h4>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="owners_sign">
                                      
                                  </div>
                                </div>
                              </div>

                              <footer id="footer">
                                powered by it-solutionsbd.com
                              </footer>
</main>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <button type="button" class="btn btn-primary btn-block product_ledger_print_btn" onclick="printDiv('printcontent');"><i class="fa fa-print"></i> Print</button>
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
}

$("#preview-due").hide();
$(".show_due").click(function(){
  $("#preview-due").toggle(500);
});
</script>
@endsection

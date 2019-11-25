@extends('layouts.app')
@section('title')
  Product Ledger
@endsection
@section('header-script')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('back/css/print.css') }}">
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
                                    <p id="company_name">{{ $company->name }}</p>
                                    <p id="company_address">{{ $company->address }}</p>
                                    <p id="company_mobile_email">{{ $company->mobile.' '.$company->email }}</p>
                                  </div>
                                </div>
                              </div>


                              <div class="row">
                                <div class="col-md-3 col-xs-3">
                                </div>
                                <div class="col-md-3 col-xs-3">
                                  
                                </div>
                                <div class="col-md-3 col-xs-3">
                                  
                                </div>
                                <div class="col-md-3 col-xs-3">
                                  <label>Date</label>
                                  <div class="input-group date" data-date-format="dd.mm.yyyy">
                                    <input  type="text" class="form-control" placeholder="dd.mm.yyyy" value="{{ Carbon\Carbon::now()->format('d.m.Y') }}">
                                    <div class="input-group-addon" >
                                      <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                  </div>
                                </div>
                              </div>



                              <table class="table table-bordered">
                                <tbody>
                                  <tr>
                                    <td style="width: 10px;">Name</td>
                                    <td>{{ $product_info->name }}</td>
                                  </tr>
                                  <tr>
                                    <td style="width: 10px;">Sale Price</td>
                                    <td>{{ $product_info->sale_price }}</td>
                                  </tr>
                                </tbody>
                              </table>

                           
                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>SL</th>
                                    <th>Date</th>
                                    <th>Invoice</th>
                                    <th>Add Stocks</th>
                                    <th>Delivery Stocks</th>
                                    <th>Lost Stocks</th>
                                    <th>Balance</th>
                                    <th>Note</th>
                                  </tr>
                                </thead>
                                 <tbody>
                                    @foreach($stockDatas as $item)
                                      <tr>
                                        <td style="width: 1%;">{{ $loop->iteration }}</td>
                                        <td style="width: 11%;">{{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                                        <td style="width: 13%;">
                                          @if($item->invoice_no != null)
                                            <a href="{{ url('/invoices-print/'.$item->invoice_no) }}" style="cursor: pointer;">
                                                {{ $item->invoice_no }}
                                            </a>
                                            @elseif($item->add_stock != null)
                                              {{ 'Add Stocks' }}
                                            @elseif($item->lost_stock != null)
                                              {{ 'Adjustment Stocks' }}
                                            @endif
                                        </td>
                                        <td style="width: 10%;">{{ $item->add_stock }}</td>
                                        <td style="width: 13%;">{{ $item->sale_stock }}</td>
                                        <td style="width: 10%;">{{ $item->lost_stock }}</td>
                                        <td style="width: 15%;">{{ $item->balance }}</td>
                                        <td>
                                          {{ $item->note }}
                                        </td>
                                      </tr>
                                    @endforeach
                                    <tr>
                                      <td colspan="3" style="text-align: right;">Total</td>
                                      <td>{{ $stockDatas->sum('add_stock') }}</td>
                                      <td>{{ $stockDatas->sum('sale_stock') }}</td>
                                      <td>{{ $stockDatas->sum('lost_stock') }}</td>
                                      <td>{{ $stock->product_stock }}</td>
                                      <td></td>
                                    </tr>
                                  </tbody>
                              </table>


                              

                              <footer id="footer">
                                powered by it-solutionsbd.com
                              </footer>
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
     window.location.href = "{{ url()->current() }}";
}

$("#preview-due").hide();
$(".show_due").click(function(){
  $("#preview-due").toggle(500);
});
</script>
@endsection

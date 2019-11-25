@extends('layouts.app')
@section('title')
Stocks
@endsection
@section('content')
<div id="page-wrapper">
    <div class="main-page">
        @include('layouts.include.alert')
        <div class="forms">
            <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                <div class="form-title">
                    <h4>{{ $product_info->name.'('.$product_info->size.')' }} Ledger View</h4>
                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ url('/stocks') }}" class="btn btn-warning btn-sm" title="Add New Stock">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                            </a>

                            <br/>
                            <br/>
                            <div class="table-responsive">
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
                                @if(isset($productId))
                                    <div class="col-md-4 col-md-offset-4">
                                        <a href="{{ url('/product-ledger-print/'.$productId) }}" class="btn btn-primary btn-block"><i class="fa fa-print"></i> Print</a>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('title')
Product {{ $id }}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="main-page">
        @include('layouts.include.alert')
        <div class="forms">
            <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                <div class="form-title">
                    <h4>Product {{ $id }} ({{ $stock->product_stock }})</h4>
                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ url('/stocks') }}" class="btn btn-success btn-sm" title="Add New Stock">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                            </a>

                            <br/>
                            <br/>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Invoice No</th>
                                            <th>Product</th>
                                            <th>Sale Quantity</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($productInvoice as $key => $item)
                                        <tr>
                                            <td>{{ $key + $start_serial }}</td>
                                            <td>{{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                                            <td>{{ $item->invoice_id }}</td>
                                            <td>{{ $products[$item->product_id] }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $stock->product_stock-$item->quantity }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

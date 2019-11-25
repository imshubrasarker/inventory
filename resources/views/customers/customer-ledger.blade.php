@extends('layouts.app')
@section('title')
Customers
@endsection
@section('content')
<div id="page-wrapper">
    <div class="main-page">
        @include('layouts.include.alert')
        <div class="forms">
            <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                <div class="form-title">
                    <h4>Customers Ledger</h4>
                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Date</th>
                                            <th>Invoice</th>
                                            <th>Quanity</th>
                                            <th>Description</th>
                                            <th>Total Bill</th>
                                            <th>Payment Receive</th>
                                            <th>Payment Received By Invoice</th>
                                            <th>Balance</th>
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($payment_carts as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                                            <td>{{ $item->invoice_id }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->address }}</td>
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

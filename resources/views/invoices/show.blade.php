@extends('layouts.app')
@section('title')
Invoice {{ $invoice->id }}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="main-page">
        @include('layouts.include.alert')
        <div class="forms">
            <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                <div class="form-title">
                    <h4>Invoice {{ $invoice->id }}</h4>
                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">

                            <a href="{{ url('/invoices') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                            
                            <br/>
                            <br/>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>ID</th>
                                            <td>{{ $invoice->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Customer</th>
                                            <td>{{ $customers[$invoice->customer_id] }}</td>
                                        </tr>
                                        <tr>
                                            <th> Invoice </th>
                                            <td> {{ $invoice->invoice_id }} </td>
                                        </tr>
                                        <tr>
                                            <th> Manual Date </th>
                                            <td> 
                                                {{ Carbon\Carbon::parse($invoice->manual_date)->format('d-m-Y') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> Notebar </th>
                                            <td> 
                                                {{ $invoice->notebar }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> Grand Total Price </th>
                                            <td> {{ $invoice->grand_total_price }} </td>
                                        </tr>
                                        <tr>
                                            <th> Advanced Price </th>
                                            <td> {{ $invoice->advanced }} </td>
                                        </tr>
                                        <tr>
                                            <th> Due Amount Price </th>
                                            <td> {{ $invoice->due_amount }} </td>
                                        </tr>
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

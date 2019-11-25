@extends('layouts.app')
@section('title')
Payment {{ $payment->id }}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="main-page">
        @include('layouts.include.alert')
        <div class="forms">
            <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                <div class="form-title">
                    <h4>Payment {{ $payment->id }}</h4>
                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">

                            <a href="{{ url('/payments') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                            <a href="{{ url('/payments/' . $payment->id . '/edit') }}" title="Edit Payment"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                            
                            <br/>
                            <br/>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <th>ID</th>
                                            <td>{{ $payment->id }}</td>
                                        </tr>
                                        <tr>
                                            <th> Customer </th>
                                            <td> {{ $customers[$payment->customer_id] }} </td>
                                        </tr>
                                        <tr>
                                            <th> Manual Date </th>
                                            <td> {{ Carbon\Carbon::parse($payment->manual_date)->format('d-m-Y') }} </td>
                                        </tr>
                                        <tr>
                                            <th> Mobile No </th>
                                            <td> {{ "0".$payment->mobile_no }} </td>
                                        </tr>
                                        <tr>
                                            <th> Amount </th>
                                            <td> {{ $payment->amount }} </td>
                                        </tr>
                                        <tr>
                                            <th> Payment Method </th>
                                            <td> {{ $payment->payment_method }} </td>
                                        </tr>
                                        <tr>
                                            <th> Note </th>
                                            <td> {{ $payment->notebar }} </td>
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

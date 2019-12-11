@extends('layouts.app')
@section('title')
    Supplier Details
@endsection
@section('header-script')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="main-page">
            <a href="{{ url('/home') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <a href="{{ route('supplier.edit', $supplier->id) }}" title="Edit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
            <br>
            <br>
            @include('layouts.include.alert')
            <div class="panel">
                <div class="form-title bg-light ">
                    <h4><strong>Supplier Details </strong></h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            </thead>
                            <tbody>
                            <tr>

                                <th>Name: </th>
                                <td>{{ $supplier->name }}</td>
                            </tr>
                            <tr>

                                <th>Phone: </th>
                                <td>{{ $supplier->mobile }}</td>
                            </tr>
                            <tr>

                                <th>Opening Balance: </th>
                                <td>{{ $supplier->balance }}</td>
                            </tr>
                            <tr>

                                <th>Opening Quantity: </th>
                                <td>{{ $supplier->quantity }}</td>
                            </tr>
                            <tr>

                                <th>Address: </th>
                                <td>{{ $supplier->address }}</td>
                            </tr>
                            <tr>

                                <th>Note: </th>
                                <td>{{ $supplier->note }}</td>
                            </tr>
                            <tr>
                                <th>Created: </th>
                                <td>{{ Carbon\Carbon::parse($supplier->created_at)->format('d-M-Y ') }}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <br>
            </div>
        </div>
    </div>

@endsection

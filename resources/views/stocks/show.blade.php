@extends('layouts.app')
@section('title')
Stock {{ $stock->id }}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="main-page">
        @include('layouts.include.alert')
        <div class="forms">
            <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                <div class="form-title">
                    <h4>Stock:- {{ $product->name }}</h4>
                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">

                            <a href="{{ url('/stocks') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                            <a href="{{ url('/stocks/' . $stock->id . '/edit') }}" title="Edit Stock"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                            
                            <br/>
                            <br/>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <th>ID</th>
                                            <td>{{ $stock->id }}</td>
                                        </tr>
                                        <tr>
                                            <th> Product </th>
                                            <td> {{ $product->name }} </td>
                                        </tr>
                                        <tr>
                                            <th> Add Stock </th>
                                            <td> {{ $stock->product_stock }} </td>
                                        </tr>
                                        <tr>
                                            <th> Sale Stock </th>
                                            <td> {{ $product_carts->sum('quantity') }} </td>
                                        </tr>
                                        <tr>
                                            <th> Balance Now </th>
                                            <td> {{ $stock->product_stock-$product_carts->sum('quantity') }} </td>
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

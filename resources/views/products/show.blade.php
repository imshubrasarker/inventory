@extends('layouts.app')
@section('title')
Product {{ $product->id }}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="main-page">
        @include('layouts.include.alert')
        <div class="forms">
            <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                <div class="form-title">
                    <h4>Product {{ $product->name }}</h4>
                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">

                            <a href="{{ url('/products') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                            @hasrole('Admin')
                            <a href="{{ url('/products/' . $product->id . '/edit') }}" title="Edit Product"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                            @endhasrole
                            <br/>
                            <br/>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <th>ID</th>
                                            <td>{{ $product->id }}</td>
                                        </tr>
                                        <tr>
                                            <th> Name </th>
                                            <td> {{ $product->name }} </td>
                                        </tr>
                                        <tr>
                                            <th> Size </th>
                                            <td> {{ $product->size }} </td>
                                        </tr>
                                        <tr>
                                            <th> Buy Price </th>
                                            <td> {{ $product->buy_price }} </td>
                                        </tr>
                                        @if(count($units))
                                        <tr>
                                            <th> Unit </th>
                                            <td> {{ $units[$product->unit_id] }} </td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <th> Category </th>
                                            <td> {{ $categories[$product->category_id] }} </td>
                                        </tr>
                                        <tr>
                                            <th> Discount </th>
                                            <td> {{ $product->discount }} </td>
                                        </tr>
                                        <tr>
                                            <th> Description </th>
                                            <td> {{ $product->description }} </td>
                                        </tr>
                                        <tr>
                                            <th> Alert Quantity </th>
                                            <td> {{ $product->alert_quantity }} </td>
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

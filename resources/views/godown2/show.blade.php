@extends('layouts.app')
@section('title')
    Supplier Details
@endsection
@section('header-script')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="main-page">
            <a href="{{ route('godown2.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
{{--            <a href="{{ route('godown2.index', $supplier->id) }}" title="Edit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>--}}
            <br>
            <br>
            @include('layouts.include.alert')
            <div class="panel">
                <div class="form-title bg-light ">
                    <h4><strong>Item Details </strong></h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Size</th>
                                <th scope="col">Color</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Note</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td scope="row"> {{ $loop->index + 1  }}</td>
                                    <td>{{ $item->products->name }}</td>
                                    <td>{{ $item->size }}</td>
                                    <td>{{ $item->godownUnits->unit_name }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->note }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td> <div class="col-md-3">
                                            <a href="{{ route('godown2.edit', $item->id) }}" type="button" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
                <br>
                <br>
            </div>
        </div>
    </div>

@endsection

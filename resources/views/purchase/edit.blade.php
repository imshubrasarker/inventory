@extends('layouts.app')
@section('title')
    Edit Purchase
@endsection
@section('header-script')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="main-page">
            @include('layouts.include.alert')
            <div class="forms">
                <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                    <div class="form-title">
                        <h4>Edit Purchase</h4>
                    </div>
                    <div class="form-body">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ url('/home') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                                <br>
                                <br>
                                @if ($errors->any())
                                    <ul class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                <form action="{{ route('purchase.update', $purchase->id) }}" method="post">
                                    @csrf
                                    {{method_field('patch')}}
                                    <div class="row mb-2">
                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Supplier<span class="text-danger">*</span></label>
                                                <select name="supplier_id" id="supplier" class="form-control">
                                                    <option value="">Select Supplier</option>
                                                    @foreach ($suplliers as $suppler )
                                                        @if ($purchase->id === $suppler->id)
                                                            <option value="{{ $suppler->id }}" selected>{{ $suppler->name }}</option>
                                                        @else
                                                            <option value="{{ $suppler->id }}">{{ $suppler->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Date <span class="text-danger">*</span></label>
                                                <input type="date" placeholder="Date" class="form-control" name="date" required value="{{ $purchase->date }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Note</label>
                                                <textarea placeholder="Note" class="form-control" name="note">{{ $purchase->note }}</textarea>
                                            </div>
                                        </div>

                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Address <span class="text-danger">*</span></label>
                                                <textarea name="address" id="address" class="form-control">{{ $purchase->address }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Mobile Number <span class="text-danger">*</span></label>
                                                <input type="text" placeholder="Mobile Number" class="form-control" name="mobile" required value="{{ $purchase->mobile }}" >
                                            </div>
                                        </div>

                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Quantity <span class="text-danger">*</span></label>
                                                <input type="number" placeholder="Opening Balance" class="form-control" required name="quantity" value="{{ $purchase->quantity }}">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Amount</label>
                                                <input type="number" class="form-control" name="amount" placeholder="Amount" value="{{ $purchase->amount }}">
                                            </div>
                                        </div>
                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Invoice Number</label>
                                                <input type="text" class="form-control" name="invoice" placeholder="Invoice Number" value="{{ $purchase->invoice_num }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Description <span class="text-danger">*</span></label>
                                                <textarea placeholder="Description" class="form-control" name="description">{{ $purchase->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button class="btn btn-primary float-right" type="submit">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-script')
    <script>

    </script>
@endsection

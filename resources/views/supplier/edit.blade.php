@extends('layouts.app')
@section('title')
    Edit Supplier
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
                        <h4>Edit Supplier</h4>
                    </div>
                    <div class="form-body">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('supplier.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                                <br>
                                <br>
                                @if ($errors->any())
                                    <ul class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                <form action="{{ route('supplier.update', $supplier->id) }}" method="post">
                                    @csrf
                                    {{method_field('patch')}}
                                    <div class="row mb-2">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label  mb-2">Supplier Name <span class="text-danger">*</span></label>
                                                <input class="form-control" value="{{ $supplier->name }}" name="name" placeholder="Supplier Name">
                                            </div>
                                        </div>
                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Mobile Number <span class="text-danger">*</span></label>
                                                <input type="text" value="{{ $supplier->mobile }}" placeholder="Mobile Number" class="form-control" name="mobile" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label  mb-2">Opening Quantity <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" value="{{ $supplier->quantity }}" name="quantity" placeholder="Opening Quantity" required>

                                            </div>
                                        </div>
                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Opening Balance <span class="text-danger">*</span></label>
                                                <input type="number" placeholder="Opening Balance" value="{{ $supplier->balance }}" class="form-control" required name="balance">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Address <span class="text-danger">*</span></label>
                                                <textarea placeholder="Address" class="form-control" name="address">{{ $supplier->address }}</textarea>

                                            </div>
                                        </div>
                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Note</label>
                                                <textarea placeholder="Note" class="form-control" name="note">{{ $supplier->note }}</textarea>

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
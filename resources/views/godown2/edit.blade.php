@extends('layouts.app')
@section('title')
    Edit Production
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
                        <h4>Edit Production</h4>
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

                                <form action="{{ route('godown2.update', $production->id) }}" method="post">
                                    @csrf
                                    {{ method_field('patch') }}
                                    <div class="row mb-2">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label  mb-2">Name <span class="text-danger">*</span></label>
                                                <input class="form-control" name="name" placeholder="Supplier Name" value="{{ $production->name }}">
                                            </div>
                                        </div>
                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Size <span class="text-danger">*</span></label>
                                                <input type="text" placeholder="Size" class="form-control" name="size" required value="{{ $production->size }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label  mb-2">Color<span class="text-danger">*</span></label>
                                                <select class="form-control" name="color_id" id="color_id">
                                                    <option value="">Select Color</option>
                                                    @foreach ($units as $unit)
                                                        @if ($unit->id == $production->godown_unit_id)
                                                            <option value="{{ $unit->id }}" selected>{{ $unit->unit_name }}</option>
                                                        @else
                                                            <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Quantity<span class="text-danger">*</span></label>
                                                <input type="number" placeholder="Quantity" class="form-control" required name="qty" value="{{ $production->size }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Note</label>
                                                <textarea placeholder="Note" class="form-control" name="note">{{ $production->size }}</textarea>
                                            </div>
                                        </div>
                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Date</label>
                                                <input type="date" class="form-control" name="date" required placeholder="Date" value="{{ $production->date }}">
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

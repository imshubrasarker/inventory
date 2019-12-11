@extends('layouts.app')
@section('title')
Create New Unit
@endsection
@section('content')
<div id="page-wrapper">
    <div class="main-page">
        @include('layouts.include.alert')
        <div class="forms">
            <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                <div class="form-title">
                    <h4>Create New Unit</h4>
                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ url('/units') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                            <br />
                            <br />
                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            <form action="{{ route('godown-unit.index') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="" class="mb-2">Unit Name</label>
                                        <input type="text" class="form-control" name="unit_name" placeholder="Unit Name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="mb-2">Number For Dozen</label>
                                        <input type="number" class="form-control" name="unit_number" placeholder="Unit Name" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button class="btn btn-primary float-right" type="submit">Create</button>
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

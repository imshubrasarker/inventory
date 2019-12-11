@extends('layouts.app')
@section('title')
Unit {{ $dozen->id }}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="main-page">
        @include('layouts.include.alert')
        <div class="forms">
            <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                <div class="form-title">
                    <h4>Unit</h4>
                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">

                            <a href="{{ url('/home') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                            <a href="{{ route('godown-unit.edit', $dozen->id) }}" title="Edit Unit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                            <br/>
                            <br/>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <th width="40%">ID</th>
                                            <td>{{ $dozen->id }}</td>
                                        </tr>
                                        <tr>
                                            <th width="40%"> Name </th>
                                            <td> {{ $dozen->unit_name }} </td>
                                        </tr>
                                        <tr>
                                            <th width="40%"> Dozen Unit Number </th>
                                            <td> {{ $dozen->unit_number }} </td>
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

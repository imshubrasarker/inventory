@extends('layouts.app')
@section('title')
User {{ $user->id }}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="main-page">
        @include('layouts.include.alert')
        <div class="forms">
            <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                <div class="form-title">
                    <h4>User {{ $user->id }}</h4>
                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">

                            <a href="{{ url('/users') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                            {{-- <a href="{{ url('/units/' . $unit->id . '/edit') }}" title="Edit Unit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> --}}
                            <br/>
                            <br/>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <th>ID</th>
                                            <td>{{ $user->id }}</td>
                                        </tr>
                                        <tr>
                                            <th> Name </th>
                                            <td> {{ $user->name }} </td>
                                        </tr>
                                        <tr>
                                            <th> Email </th>
                                            <td> {{ $user->email }} </td>
                                        </tr>
                                        <tr>
                                            <th> Status </th>
                                            <td> 
                                                @if($user->status == 1)
                                                    <span style="color: green; font-weight: bolder;">Activated</span>
                                                @else
                                                    <span style="color: red; font-weight: bolder;">Inactivated</span>
                                                @endif
                                            </td>
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

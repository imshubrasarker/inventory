@extends('layouts.app')
@section('title')
Company {{ $company->id }}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="main-page">
        @include('layouts.include.alert')
        <div class="forms">
            <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                <div class="form-title">
                    <h4>Company {{ $company->id }}</h4>
                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">

                            <a href="{{ url('/companies') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                            <a href="{{ url('/companies/' . $company->id . '/edit') }}" title="Edit Company"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                            
                            <br/>
                            <br/>

                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th>ID</th>
                                            <td>{{ $company->id }}</td>
                                        </tr>
                                        <tr>
                                            <th> Name </th>
                                            <td> {{ $company->name }} </td>
                                        </tr>
                                        <tr>
                                            <th> Logo </th>
                                            <td> 
                                                <img src="{{ asset($company->logo) }}" alt="" style="width: 300px; height: 300px;"> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> Adddress </th>
                                            <td> {{ $company->address }} </td>
                                        </tr>
                                        <tr>
                                            <th> Mobile </th>
                                            <td> {{ $company->mobile }} </td>
                                        </tr>
                                        <tr>
                                            <th> Email </th>
                                            <td> {{ $company->email }} </td>
                                        </tr>
                                        <tr>
                                            <th> Quote </th>
                                            <td> {{ $company->quote }} </td>
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

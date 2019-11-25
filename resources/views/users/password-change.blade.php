@extends('layouts.app')
@section('title')
Password Change
@endsection
@section('content')
<div id="page-wrapper">
    <div class="main-page">
        @include('layouts.include.alert')
        <div class="forms">
            <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                <div class="form-title">
                    <h4>Password Change</h4>
                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ url('/home') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                            <br />
                            <br />
                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            <form class="form-horizontal" method="POST" action="{{ route('password-change') }}">
                                @csrf

                                <div class="form-group {{ $errors->has('old_password') ? 'has-error' : ''}}">
                                    {!! Form::label('old_password', 'Old Password', ['class' => 'control-label']) !!}
                                    {!! Form::text('old_password', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                    {!! $errors->first('old_password', '<p class="help-block">:message</p>') !!}
                                </div>
                                <div class="form-group {{ $errors->has('new_password') ? 'has-error' : ''}}">
                                    {!! Form::label('new_password', 'New Password', ['class' => 'control-label']) !!}
                                    {!! Form::text('new_password', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                    {!! $errors->first('new_password', '<p class="help-block">:message</p>') !!}
                                </div>
                                <div class="form-group {{ $errors->has('confirm_password') ? 'has-error' : ''}}">
                                    {!! Form::label('confirm_password', 'Confirm Password', ['class' => 'control-label']) !!}
                                    {!! Form::text('confirm_password', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                    {!! $errors->first('confirm_password', '<p class="help-block">:message</p>') !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
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

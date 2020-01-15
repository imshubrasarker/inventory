@extends('layouts.app')
@section('title')
    Edit Employee
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="main-page">
            @include('layouts.include.alert')
            <div class="forms">
                <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                    <div class="form-title">
                        <h4>Edit Employee</h4>
                    </div>
                    <div class="form-body">
                        <div class="card">
                            <div class="card-body">
                                @if ($errors->any())
                                    <ul class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                <form action="{{ route('employees.update', $employee->id) }}" method="post" class="form-group">
                                    @csrf
                                    {{method_field('patch')}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="name" class="">Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $employee->name }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="name" class="">Address</label>
                                            <textarea name="address" id="" placeholder="Address" class="form-control" required>{{ $employee->address }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="name" class="">Mobile</label>
                                            <input type="text" class="form-control" name="mobile" placeholder="Mobile Number" value="{{ $employee->mobile }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="name" class="">NID No</label>
                                            <input type="text" class="form-control" name="nid_no" placeholder="NID Number" value="{{ $employee->nid_no }}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="name" class="">Emergency Contact</label>
                                            <input type="text" class="form-control" name="e_contact" placeholder="Emergency Contact" value="{{ $employee->e_contact }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="name" class="">Salary Type</label>
                                            <select name="salary_type" id="salary_type" class="form-control" required>
                                                <option value="monthly" {{ $employee->salary_type === 'monthly' ? 'selected' : '' }}>Monthly</option>
                                                <option value="production" {{ $employee->salary_type === 'production' ? 'selected' : '' }}>Production</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="name" class="">Previous Salary</label>
                                            <input type="text" class="form-control" name="previous_salary" placeholder="Previous Salary" value="{{ $employee->previous_salary }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="name" class="">Previous Quantity</label>
                                            <input type="number" class="form-control" name="previous_quantity" placeholder="Previous Quantity" value="{{ $employee->previous_quantity }}" required>
                                        </div>
                                    </div>
                                    @if ($employee->salary_type === 'monthly')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="name" class="">Salary</label>
                                                <input type="text" class="form-control" name="salary" placeholder="Salary" value="{{ $employee->balance }}" required>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($employee->salary_type === 'production')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="name" class="">Rate</label>
                                                <input type="text" class="form-control" name="rate" value="{{ $employee->rate }}" required>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-md-6"></div>
                                        <div class="col-md-6">
                                            <button class="text-right btn-primary btn" type="submit">Create</button>
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

@extends('layouts.app')
@section('title')
Create New Category
@endsection
@section('content')
<div id="page-wrapper">
    <div class="main-page">
        @include('layouts.include.alert')
        <div class="forms">
            <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                <div class="form-title">
                    <h4>Add New Employee</h4>
                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ url('/employees') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                            <br />
                            <br />
                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif


                            <form action="{{ route('employees.store') }}" method="post" class="form-group">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name" class="">Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name" class="">Address</label>
                                        <textarea name="address" id="" placeholder="Address" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name" class="">Mobile</label>
                                        <input type="text" class="form-control" name="mobile" placeholder="Mobile Number" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name" class="">NID No</label>
                                        <input type="text" class="form-control" name="nid_no" placeholder="NID Number" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name" class="">Emergency Contact</label>
                                        <input type="text" class="form-control" name="e_contact" placeholder="Emergency Contact" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name" class="">Salary Type</label>
                                        <select name="salary_type" id="salary_type" class="form-control" required>
                                            <option value="">--- Select Salary Type ---</option>
                                            <option value="monthly">Monthly</option>
                                            <option value="production">Production</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name" class="">Previous Salary</label>
                                        <input type="text" class="form-control" name="previous_salary" placeholder="Previous Salary" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name" class="">Previous Quantity</label>
                                        <input type="number" class="form-control" name="previous_quantity" placeholder="Previous Quantity" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" id="salary_div" style="display: none">
                                        <label for="name" class="">Salary</label>
                                        <input type="text" class="form-control" name="salary" id="salary" placeholder="Salary" required>
                                    </div>
                                </div>
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

@section('footer-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('change', '#salary_type', function () {
                var type = $(this).val();

                console.log("Val ", type);

                if (type == 'monthly') {
                    $('#salary_div').css('display', 'block');
                }

                if (type == 'production') {
                    $('#salary_div').css('display', 'none');
                }
            })
        });
    </script>
@endsection

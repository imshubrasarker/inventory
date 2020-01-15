@extends('layouts.app')
@section('title')
Create New Salary
@endsection
@section('header-script')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div id="page-wrapper">
    <div class="main-page">
        @include('layouts.include.alert')
        <div class="forms">
            <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                <div class="form-title">
                    <h4>Pay Salary</h4>
                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ url('/salary') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                            <br />
                            <br />
                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif


                            <form action="{{ route('salary.store') }}" method="post" class="form-group">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name" class="">Employee</label>
                                        <select name="employee_id" id="employee_id" class="form-control select2">
                                            <option value="">--- Select Employee ---</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name" class="">Address</label>
                                        <textarea name="address" id="address" placeholder="Address" class="form-control" readonly></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name" class="">Mobile</label>
                                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name" class="">Salary Type</label>
                                        <input type="text" class="form-control" readonly id="salary_type">
                                    </div>
                                </div>
                                <div class="row" id="hiderow" style="display: none">
                                    <div class="col-md-6">
                                        <label for="name" class="">Quantity</label>
                                        <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name" class="">Rate</label>
                                        <input type="text" class="form-control" id="rate" name="rate" placeholder="Rate" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name" class="">Salary</label>
                                        <input type="text" class="form-control" id="salary" name="salary" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name" class="">Note</label>
                                        <textarea name="note" id="note" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name" class="">Designation</label>
                                        <input type="text" class="form-control" id="designation" name="designation" readonly>
                                    </div>
                                    <div class="col-md-6" id="month">
                                        <label for="name" class="">Month</label>
                                        <input type="month" class="form-control" name="month" id="month">
                                    </div>
                                </div>
                                <div class="row" id="working-day" style="display: none;">
                                    <div class="col-md-6">
                                        <label for="name" class="">Working Day</label>
                                        <input type="text" class="form-control" id="working_day" name="working_day">
                                        <input type="hidden" name="daily_salary" id="daily_salary">
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
            $('.select2').select2();
            $(document).on('change','#employee_id',function(){

                var product_id = $(this).val();

                var serial = $(this).attr('serial');
                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:"GET",
                    url:"{{ route('get_employee_detail') }}",
                    data: {
                        employee_id : product_id
                    },
                    success : function(results) {
                        $('#address').val(results.employee.address);
                        $('#mobile').val(results.employee.mobile);
                        $('#salary_type').val(results.employee.salary_type);
                        $('#designation').val(results.employee.designation);
                        if (results.employee.salary_type == 'monthly') {
                            $('#hiderow').css('display', 'none');
                            // $('#salary').val(results.employee.balance);
                            $('#working-day').css('display', 'block');
                            $('#month').css('display', 'block');
                            $('#daily_salary').val(results.employee.balance/30);
                            salary_calculate();
                        }
                        if (results.employee.salary_type == 'production') {
                            $('#hiderow').css('display', 'block');
                            $('#salary').val(0);
                            $('#working-day').css('display', 'none');
                            $('#month').css('display', 'none');
                            $('#rate').val(results.employee.rate);
                            salary_calculate();
                        }
                    }
                });
            });
            $(document).on('keyup', '#quantity', function () {
                var qty = $(this).val();
                var rate = $('#rate').val() ? $('#rate').val() : 0;
                $('#salary').val(qty * rate);
            })

            function salary_calculate() {
                var working_days = $('#working_day').val() ? $('#working_day').val() : 0;
                console.log('Working day ', working_days);
                var salary = $('#daily_salary').val() ? $('#daily_salary').val() : 0;
                console.log("Salary ", salary);
                $('#salary').val(working_days * salary);
            }

            $(document).on('keyup', '#working_day', function () {
                salary_calculate();
            })

            $(document).on('keyup', '#rate', function () {
                var rate = $(this).val();
                var qty = $('#quantity').val() ? $('#quantity').val() : 0;
                $('#salary').val(qty * rate);
            })
        });
    </script>
@endsection

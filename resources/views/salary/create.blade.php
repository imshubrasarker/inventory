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
                                        <input type="text" class="form-control" id="rate" name="rate" placeholder="Rate">
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
                                        <select name="month" class="form-control">
                                            <option value="">Select Month</option>
                                            <option value="january">January</option>
                                            <option value="february">February</option>
                                            <option value="march">March</option>
                                            <option value="april">April</option>
                                            <option value="may">May</option>
                                            <option value="june">June</option>
                                            <option value="july">July</option>
                                            <option value="august">August</option>
                                            <option value="september">September</option>
                                            <option value="october">October</option>
                                            <option value="november">November</option>
                                            <option value="december">December</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" id="working-day">
                                    <div class="col-md-6">
                                        <label for="name" class="">Working Day</label>
                                        <input type="text" class="form-control" id="working day" name="working day">
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
                        console.log(results);
                        if (results.employee.salary_type == 'monthly') {
                            $('#hiderow').css('display', 'none');
                            $('#salary').val(results.employee.balance);
                            $('#working-day').css('display', 'none');
                            $('#month').css('display', 'block');
                        }
                        if (results.employee.salary_type == 'production') {
                            $('#hiderow').css('display', 'block');
                            $('#salary').val(0);
                            $('#working-day').css('display', 'block');
                            $('#month').css('display', 'none');
                        }
                    }
                });
            });
            $(document).on('keyup', '#quantity', function () {
                var qty = $(this).val();
                var rate = $('#rate').val() ? $('#rate').val() : 0;
                $('#salary').val(qty * rate);
            })

            $(document).on('keyup', '#rate', function () {
                var rate = $(this).val();
                var qty = $('#quantity').val() ? $('#quantity').val() : 0;
                $('#salary').val(qty * rate);
            })
        });
    </script>
@endsection

@extends('layouts.app')
@section('title')
Employee {{ $employee->id }}
@endsection
@section('header-script')
    <style>
        header {
            padding: 10px 0;
            margin-bottom: 15px;
            border-bottom: 1px solid #AAAAAA;
        }

        #logo {
            float: left;
            margin-top: 6px;
        }

        #logo img {
            height: 150px;
        }

        #company {
            float: right;
            text-align: right;
        }

        #details {
            margin-bottom: 50px;
        }

        .column {
            float: left;
            width: 50%;
            padding: 10px;
            height: 50px; /* Should be removed. Only for demonstration */
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
@endsection
@section('content')
<div id="page-wrapper">
    <div class="main-page">
        @include('layouts.include.alert')
        <div class="forms">
            <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                <div class="form-title">
                    <h4>Employee {{ $employee->id }}</h4>
                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">

                            <a href="{{ url('/employees') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                            <br/>
                            <br/>

                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th>ID</th>
                                            <td>{{ $employee->id }}</td>
                                        </tr>
                                        <tr>
                                            <th> Name </th>
                                            <td> {{ $employee->name }} </td>
                                        </tr>
                                        <tr>
                                            <th> Address </th>
                                            <td> {{ $employee->address }} </td>
                                        </tr>
                                        <tr>
                                            <th> Emergency Contact </th>
                                            <td> {{ $employee->e_contact }} </td>
                                        </tr>
                                        @if($employee->salary_type == 'monthly')
                                            <tr>
                                                <th> Salary </th>
                                                <td> {{ $employee->balance }} </td>
                                            </tr>
                                        @endif
                                        @if($employee->salary_type == 'production')
                                            <tr>
                                                <th> Rate </th>
                                                <td> {{ $employee->rate }} </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <th> Mobile </th>
                                            <td> {{ $employee->mobile }} </td>
                                        </tr>
                                        @if($employee->salary_type == 'monthly')
                                            <tr>
                                                <th> Previous Salary </th>
                                                <td> {{ $employee->previous_salary }} </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <th> Designation </th>
                                            <td> {{ $employee->designation }} </td>
                                        </tr>
                                        <tr>
                                            <th> Salary Type </th>
                                            <td> {{ $employee->salary_type }} </td>
                                        </tr>
                                        <tr>
                                            <th> NID No </th>
                                            <td> {{ $employee->nid_no }} </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                    <div class="card" id="printcontent">
                        <div class="card-header">
                            <h2 style="margin-top: 20px; margin-bottom: 20px;">Salary History</h2>
                        </div>
                        <div class="form-title bg-light" id="company_details" style="display: none">
                            <header class="clearfix">
                                <div id="logo">
                                    <img src="{{ asset($company->logo) }}">
                                </div>
                                <div id="company">
                                    <h3 class="name"><b>{{ $company->name }}</b></h3>
                                    <div><font size="3">Didar Nibash . 83 / 2 Muradpur High School Road . <br>Jurain .
                                            Kadomtoli . Dhaka - 1204 . E - BIN :001437901-0308</font></div>
                                    <div><font size="3">{{ $company->mobile}}</font></div>
                                    <div><a href="#"><font size="3">{{$company->email }}</font></a></div>
                                </div>
                            </header>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        @if($employee->salary_type == 'monthly')
                                            <th colspan="2">Month Of Salary</th>
                                        @endif
                                        <th>Note</th>
                                        @if($employee->salary_type == 'production')
                                            <th>Quantity</th>
                                        @endif
                                        <th>Paid Salary</th>
                                        <th>Salary</th>
                                        <th>Balance</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $total = 0;
                                        $total_qty = 0;
                                        $toatl_payable = 0;
                                        $balance = 0;
                                    @endphp
                                    @foreach ($employee->salaries as $item)
                                        @php
                                            $total = $total + $item['balance'];
                                            $total_qty = $total_qty + $item['qty_desc'];
                                            if ($employee->salary_type == 'production') {
                                                $balance = $balance + $item->paid_salary - $item->balance;
                                                $toatl_payable = $toatl_payable + $item->paid_salary;
                                            } else if($employee->salary_type == 'monthly'){
                                                $balance = $balance + $item->employee->balance - $item->balance;
                                                $toatl_payable = $toatl_payable + $item->balance;
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item['created_at'])) }}</td>

                                            @if($employee->salary_type == 'monthly')
                                                <td colspan="2">{{ date('M-Y', strtotime($item['month'])) }}</td>
                                            @endif

                                            <td>{{ $item['note'] }}</td>

                                            @if($employee->salary_type == 'production')
                                                <td>{{ $item['qty_desc'] }}</td>
                                            @endif

                                            @if($employee->salary_type == 'production')
                                                <td>{{ $item->paid_salary }}</td>
                                            @elseif($employee->salary_type == 'monthly')
                                                <td>{{ $item->balance }}</td>
                                            @endif

                                            @if($employee->salary_type == 'production')
                                                <td>{{ $item['balance'] }}</td>
                                            @elseif($employee->salary_type == 'monthly')
                                                <td>{{ $item->employee->balance }}</td>
                                            @endif
                                            <td>{{ $balance }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3" class="text-right">Total</td>
                                        <td>{{ $total_qty }}</td>
                                        <td>{{ $toatl_payable }}</td>
                                        <td>{{ $total }}</td>
                                        <td>{{ $balance }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary print_btn btn-block btn-sm"
                                onclick="printDiv('printcontent');"><i class="fa fa-print"></i> Print
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-script')
    <script type="text/javascript">
        function printDiv(divName) {
            $('.print_btn').css('display', 'none');
            $('#company_details').css('display', 'block');
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            $('.company_details').css('display', 'none');

            document.body.innerHTML = originalContents;
            $('.print_btn').css('display', 'block');
            window.location.href = "{{ url()->current() }}";
        }
    </script>
@endsection

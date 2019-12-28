@extends('layouts.app')
@section('title')
Employee {{ $employee->id }}
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
                                        <tr>
                                            <th> Salary </th>
                                            <td> {{ $employee->balance }} </td>
                                        </tr>
                                        <tr>
                                            <th> Mobile </th>
                                            <td> {{ $employee->mobile }} </td>
                                        </tr>
                                        <tr>
                                            <th> Previous Salary </th>
                                            <td> {{ $employee->previous_salary }} </td>
                                        </tr>
                                        <tr>
                                            <th> Previous Quantity </th>
                                            <td> {{ $employee->previous_quantity }} </td>
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

                    <div class="card">
                        <div class="card-header">
                            <h2 style="margin-top: 20px; margin-bottom: 20px;">Salary History</h2>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Note</th>
                                        <th>Amount</th>
                                        <th>Quantity</th>
                                        <th>Rate</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $total = 0;
                                        $total_qty = 0;
                                    @endphp
                                    @foreach ($employee->salaries as $item)
                                        @php
                                            $total = $total + $item->balance;
                                            $total_qty = $total_qty + $item->qty_desc;
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                            <td>{{ $item->note }}</td>
                                            <td>{{ $item->balance }}</td>
                                            <td>{{ $item->qty_desc }}</td>
                                            <td>{{ $item->rate }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3" class="text-right">Total</td>
                                        <td>{{ $total }}</td>
                                        <td>{{ $total_qty }}</td>
                                        <td></td>
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

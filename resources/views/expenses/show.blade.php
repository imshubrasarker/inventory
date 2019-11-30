@extends('layouts.app')
@section('title')
    Expenses Details
@endsection
@section('header-script')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="main-page">
            <a href="{{ route('expenses.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <a href="{{ route('expenses.edit', $expense->id) }}" title="Edit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
            <br>
            <br>
            @include('layouts.include.alert')
            <div class="panel">
                <div class="form-title bg-light ">
                    <h4><strong>Expense Details </strong></h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            </thead>
                            <tbody>
                            <tr>

                                <th>Title: </th>
                                <td>{{ $expense->title }}</td>
                            </tr>
                            <tr>
                                <th>Date: </th>
                                <td>{{ Carbon\Carbon::parse($expense->date)->format('d-M-Y ') }}</td>
                            </tr>
                            <tr>
                                <th>Amount: </th>
                                <td>{{ $expense->amount }}</td>
                            </tr>
                            <tr>
                                <th>Note: </th>
                                <td>{{ $expense->note }}</td>
                            </tr>
                            <tr>
                                <th>Expense Head: </th>
                                <td>{{ $expense->expenseHead->title }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <br>
            </div>
        </div>
    </div>

@endsection

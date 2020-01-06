@extends('layouts.app')
@section('title')
    Manage Expenses
@endsection
@section('header-script')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="main-page">
            <a href="{{ url('/home') }}" title="Back">
                <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
            </a>
            <br>
            <br>
            @include('layouts.include.alert')
            <div class="panel">
                <div class="form-title  ">
                    <div class="row">
                        <div class="col-sm-12 ">
                            <h4>Expenses</h4>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <form action="{{ route('expenses-search') }}" method="get">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-3">
                            <div class="input-group date" data-date-format="yyyy.mm.dd">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th">  From</span>
                                </div>
                                <input value="{{ date("Y-m-d") }}" id="StartDate" type="text" name="from"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="input-group date" data-date-format="yyyy.mm.dd">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th">  To</span>
                                </div>
                                <input value="{{date("Y-m-d")}}" id="EndDate" type="text" name="to"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="col-md-2">
                        <span class="input-group-append">
                            <button class="btn btn-secondary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                        </div>
                    </div>
                </form>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr style="color: #00a78e">
                                <th scope="col"><i class="fa fa-list-ol" aria-hidden="true"></i></th>
                                <th scope="col"><i class="fa fa-gg" aria-hidden="true"></i> Expense Head</th>
                                <th scope="col" width="20%"><i class="fa fa-gg" aria-hidden="true"></i> Title</th>
                                <th scope="col"><i class="fa fa-comments-o" aria-hidden="true"></i> Note</th>
                                <th scope="col"><i class="fa fa-money" aria-hidden="true"></i> Amount</th>
                                <th scope="col"><i class="fa fa-calendar" aria-hidden="true"></i> Date</th>
                                <th scope="col"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</th>
                                <th scope="col"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $total_exp = 0 ;
                            @endphp
                            @foreach($expenses as $expense)
                                @php
                                    $total_exp = $total_exp + $expense->amount;
                                @endphp
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    @if($expense->expenses_heads_id == 0)
                                        <td class="text-success">Flash</td>
                                    @else
                                    <td>{{ $expense->expenseHead['title'] }}</td>
                                    @endif
                                    <td><a href="{{ route('expenses.show', $expense->id) }}">{{ $expense->title }}</a></td>
                                    <td>{{ $expense->note }}</td>
                                    <td>{{ $expense->amount }}</td>
                                    <td>{{ Carbon\Carbon::parse($expense->date)->format('d-M-Y ') }}</td>
                                    <td>
                                        <a class="btn btn-primary"
                                           href="{{ route('expenses.edit', $expense->id) }}">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                                                onclick="deleteHead('{{ route('expenses.destroy', $expense->id) }}')">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-right font-weight-bold"><i class="fa fa-money" aria-hidden="true"></i> Total Amount: </td>
                                <td>{{ $total_exp }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                        <div>
                            <a href="{{ route('expence.print') }}" class="btn btn-primary print_btn btn-block btn-sm"><i class="fa fa-print"></i> Print</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel">
            </div>
        </div>
    </div>
    @include('shared.delete-modal')

@endsection

@section('footer-script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript">
        $("#EndDate").change(function () {
            var startDate = document.getElementById("StartDate").value;
            var endDate = document.getElementById("EndDate").value;

            if ((Date.parse(startDate) >= Date.parse(endDate))) {
                alert("End date should be greater than Start date");
                document.getElementById("EndDate").value = "";
            }
        });

        $('.input-group.date').datepicker({format: "yyyy-mm-dd"});
        $('#customer_id').select2();
        $('#customer_mobile').select2();
    </script>

    <script>

        function deleteHead(route) {
            $('#deleteForm').attr("action", route);
        }
    </script>
@endsection

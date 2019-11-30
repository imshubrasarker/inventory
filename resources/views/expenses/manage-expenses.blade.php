@extends('layouts.app')
@section('title')
    Manage Expenses
@endsection
@section('header-script')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="main-page">
            <a href="{{ url('/home') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <br>
            <br>
            @include('layouts.include.alert')
            <div class="panel">
                <div class="form-title bg-light ">
                    <div class="row">
                        <div class="col-sm-12">
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
                                <div class="input-group-addon" >
                                    <span class="glyphicon glyphicon-th">  From</span>
                                </div>
                                <input value="{{ date("Y-m-d") }}" id="StartDate" type="text" name="from" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="input-group date" data-date-format="yyyy.mm.dd">
                                <div class="input-group-addon" >
                                    <span class="glyphicon glyphicon-th">  To</span>
                                </div>
                                <input value="{{date("Y-m-d")}}" id="EndDate" type="text" name="to" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-2">
                        <span class="input-group-append">
                            <button class="btn btn-secondary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                        </div>
                </form>
                </div>
                @foreach($heads as $head)
                <div class="form-title ">
                   <div class="row">
                       <div class="col-sm-6">
                           <h4> <strong>Expense Head: </strong>{{ $head->title }}</h4>
                       </div><div class="col-sm-6">
                           <h4 class="text-right"> <strong>Total: </strong>{{ $head->expenses->sum('amount') }}</h4>
                       </div>
                   </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Title</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Note</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                            $total =0 ;
                            @endphp
                            @foreach($head->expenses as $expense)
                                <tr>
                                    <th scope="row">{{ $loop->index +1 }}</th>
                                    <td>{{ Carbon\Carbon::parse($expense->date)->format('d-M-Y ') }}</td>
                                    <td><a href="{{ route('expenses.show', $expense->id) }}">{{ $expense->title }}</a></td>
                                    <td>{{ $expense->amount }}</td>
                                    <td>{{ $expense->note }}</td>
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
                            </tbody>
                        </table>
                    </div>
                </div>
                    @endforeach
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

        function deleteHead(route){
            $('#deleteForm').attr("action", route);
        }
    </script>
@endsection
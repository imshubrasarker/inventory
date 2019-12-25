@extends('layouts.app')
@section('title')
    Print Expenses
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
        <div id="printcontent" style="padding: 5px; overflow: hidden;">
            <div class="main-page">
                <div class="panel">
                    <div class="form-title bg-light ">
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
                    <div class="row">
                        <div class="column">
                            <div class="input-group date" data-date-format="yyyy.mm.dd">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th">  From</span>
                                </div>
                                <input value="{{ date("Y-m-d") }}" id="StartDate" type="text" name="from"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="column">
                            <div class="input-group date" data-date-format="yyyy.mm.dd">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th">  To</span>
                                </div>
                                <input value="{{date("Y-m-d")}}" id="EndDate" type="text" name="to"
                                       class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div style="margin-bottom: 40px">
                            <h3>Total Expense : {{ $total }}</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Expense Head</th>
                                    <th scope="col">Note</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $total =0 ;
                                @endphp
                                @foreach($expenses as $expense)
                                    <tr>
                                        <th scope="row">{{ $loop->index +1 }}</th>
                                        <td>{{ Carbon\Carbon::parse($expense->date)->format('d-M-Y ') }}</td>
                                        <td>
                                            <a>{{ $expense->title }}</a>
                                        </td>
                                        <td>{{ $expense->amount }}</td>
                                        <td>{{ $expense->expenseHead->title }}</td>
                                        <td>{{ $expense->note }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
            $('.print_btn').css('display', 'block');
            window.location.href = "{{ url()->current() }}";
        }
    </script>
@endsection

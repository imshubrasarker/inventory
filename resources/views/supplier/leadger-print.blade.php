@extends('layouts.app')
@section('title')
    Supplier {{ $supplier->id }}
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
        #invoice {
            float: right;
            text-align: right;
        }

        #invoice h1 {
            color: #0087C3;
            font-size: 13px;
            line-height: 1em;
            font-weight: normal;
            margin: 0 0 10px 0;
        }

        #invoice .date {
            font-size: 12px;
            color: #777777;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('back/css/customer.css') }}">
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="main-page">
            <div class="forms">
                <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                    <div class="form-title">
                        <h4>Suppler :- {{ $supplier->name }}</h4>
                    </div>
                    <div class="form-body">
                        <div class="card">
                            <div class="card-body">
                                <div id="printcontent" style="padding: 5px; overflow: hidden;">
                                    <header class="clearfix">
                                        <div id="logo">
                                            <img src="{{ asset($company->logo) }}">
                                        </div>
                                        <div id="company">
                                            <h3 class="name"><b>{{ $company->name }}</b> </h3>
                                            <div ><font size="3">Didar Nibash . 83 / 2 Muradpur High School Road . <br>Jurain . Kadomtoli . Dhaka - 1204 . E - BIN :001437901-0308</font></div>
                                            <div><font size="3">{{ $company->mobile}}</font></div>
                                            <div><a href="#"><font size="3">{{$company->email }}</font></a></div>
                                        </div>
                                    </header>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="">
                                                <div id="details" class="clearfix" style="overflow: hidden">
                                                    <div id="client" style="float: left">
                                                        <div class="to">Ladger To:</div>
                                                        <h4 class="name">{{ $supplier->name }}</h4>
                                                        <div class="address">{{ $supplier->address }}</div>
                                                        <div class="email"><a href="#">{{ $supplier->mobile }}</a></div>
                                                    </div>
                                                    <div id="invoice" style="float: right">
                                                        <div class="date">Date: {{ Carbon\Carbon::now()->format('d.m.Y') }}</div>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div class="">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                <tr>
                                                                    <th>SL.</th>
                                                                    <th>Date</th>
                                                                    <th>Invoice</th>
                                                                    <th>Quantity</th>
                                                                    <th>Purchase Amount</th>
                                                                    <th>Paid Amount</th>
                                                                    {{--<th>Due Amount</th>--}}
                                                                    <th>Balance</th>
                                                                    <th>Note</th>
                                                                    <th>Receipt By</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @php
                                                                    $i = 1;
                                                                    $gtotal = 0;
                                                                    $pgtotal = 0;
                                                                    $sgtotal = 0;
                                                                    $qSum = 0;
                                                                    $purAmount = 0;
                                                                    $paidAmount = 0;
                                                                @endphp
                                                                @if(isset($results))
                                                                    @foreach($results as $key2 => $item)
                                                                        @php
                                                                            $gtotal = $gtotal;
                                                                        @endphp
                                                                        <tr>
                                                                            <td style="width: 1%;"> {{$key2+1}}</td>
                                                                            <td style="width: 11%;">
                                                                                {{ Carbon\Carbon::parse($item['created_at'])->format('d-m-Y') }}
                                                                            </td>
                                                                            <td>
                                                                                @if($item['ivno'])
                                                                                    <a style="cursor: pointer;"> {{ $item['ivno'] }}</a>
                                                                                @endif </td>
                                                                            <td style="width: 10%;">{{ $item['qty'] }}</td>
                                                                            <td style="width: 14%;">{{ $item['purAmount'] }}</td>
                                                                            <td style="width: 15%;">{{ $item['paidAmount'] }}</td>
                                                                            {{--  <td style="width: 12%;">{{ $item['damount'] }}</td> --}}
                                                                            @php

                                                                                if($item['type'] == 'payments'){
                                                                                $paidAmount = $paidAmount + $item['paidAmount'];
                                                                                 $sgtotal = $sgtotal + $item['amount'];
                                                                                }
                                                                                if(($item['type'] == 'supplier') || ($item['type'] == 'purchase') ){
                                                                                    $qSum = $qSum + $item['qty'];
                                                                                 $pgtotal = $pgtotal + $item['amount'];
                                                                                }
                                                                                if ($item['type'] == 'purchase')
                                                                                    {
                                                                                        $purAmount = $purAmount + $item['purAmount'];
                                                                                    }
                                                                                $gtotal = $pgtotal - $sgtotal;
                                                                            @endphp
                                                                            <td style="width: 12%;">{{$gtotal}}</td>
                                                                            <td>{{ $item['note'] }}</td>
                                                                            @php
                                                                                $user = App\User::where('id',$item['user_id'])->first();
                                                                            @endphp
                                                                            @if($item['user_id'])
                                                                                <td style="width: 10%;">{{$user->name}} </td>
                                                                            @else
                                                                                <td style="width: 10%;"> </td>
                                                                            @endif
                                                                        </tr>
                                                                        @php
                                                                            $i++;
                                                                        @endphp
                                                                    @endforeach
                                                                @endif
                                                                <tr>
                                                                    <td colspan="3" class="text-right">Total:</td>
                                                                    <td>{{ $qSum }}</td>
                                                                    <td>{{ $purAmount }}</td>
                                                                    <td>{{ $paidAmount }}</td>
                                                                    <td>{{ $gtotal }}</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                            @if(isset($supplier->id))
                                                                <div class="col-md-4 col-md-offset-4">
                                                                    <button type="button" class="btn btn-primary btn-block product_ledger_print_btn" onclick="printDiv('printcontent');"><i class="fa fa-print"></i> Print</button>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-script')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js"></script>
    <script>
        $('.input-group.date').datepicker({format: "dd.mm.yyyy"});

        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            $('.product_ledger_print_btn').hide();

            window.print();

            $('.product_ledger_print_btn').show();

            document.body.innerHTML = originalContents;
        }

        $("#preview-due").hide();
        $(".show_due").click(function(){
            $("#preview-due").toggle(500);
        });
    </script>
@endsection

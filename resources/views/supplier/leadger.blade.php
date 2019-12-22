@extends('layouts.app')
@section('title')
    Supplier {{ $supplier->id }}
@endsection
@section('header-script')
    <link rel="stylesheet" type="text/css" href="{{ asset('back/css/customer.css') }}">
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="main-page">
            @include('layouts.include.alert')
            <div class="forms">
                <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                    <div class="form-title">
                        <h4>Suppler :- {{ $supplier->name }}</h4>
                    </div>
                    <div class="form-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="row" id="customer">
                                    <div class="col-md-4">
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <h4 class="card-title text-center">{{ $supplier->name }}</h4>
                                                    <div class="row customer_invoice_info">
                                                        <div class="col-md-6 total_invoice">
                                                            <h4 class="text-center">{{ $purchases->count() }}</h4>
                                                            <h3 class="text-center">TOTAL PURCHASE</h3>
                                                        </div>
                                                        <div class="col-md-6 total_buy">
                                                            <h4 class="text-center">
                                                                {{ $purchases->sum('amount') }}
                                                            </h4>
                                                            <h3 class="text-center">TOTAL BUY</h3>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4"></div>
                                                        <div class="col-md-4">
                                                            <a href="#" class="btn btn-sm btn-success">Buy Now</a>
                                                        </div>
                                                        <div class="col-md-4"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="panel-group">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                    <h4 class="text-center text-white">Contact Information</h4>
                                                </div>
                                                <div class="panel-body contact_info">
                                                    <h4 class="text-center"><b>Mobile:</b>
                                                        {{ $supplier->mobile }}
                                                    </h4>
                                                    <h4 class="text-center" sty><b>Address:</b></h4>
                                                    <p style="word-break: break-all; text-align: center;">{{ $supplier->address }}</p>
                                                    <h4 class="text-center" sty><b>Note:</b></h4>
                                                    <p style="word-break: break-all; text-align: center;">{{ $supplier->note }}</p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="panel-group">
                                            <div class="panel panel-success">
                                                <div class="panel-heading">
                                                    <h4 style="float: left;">Balance Information</h4>
                                                    <a href="{{ url('payment/create/'.$supplier->id . '?type=supplier') }}" class="btn btn-sm btn-primary pull-right">Payment</a>
                                                </div>
                                                @php
                                                    $grand_total_price = $purchases->sum('amount');
                                                    $paid_price = $payments->sum('amount');
                                                    $due_amount = $grand_total_price - $paid_price;
                                                @endphp
                                                <div class="panel-body balance_info">
                                                    <h4>Total Amount: {{ $purchases->sum('amount') }}TK</h4>
                                                    <h4>Paid Amount: {{ $paid_price }}TK</h4>
                                                    @if($grand_total_price > $paid_price)
                                                        <h4>Due Amount: {{ $due_amount }}TK </h4>
                                                    @else
                                                        <h4>Due Amount: {{ $due_amount }}TK </h4>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            Customer Ledger
                                                        </div>
                                                        <div class="col-md-8">
                                                            {!! Form::open(['method' => 'GET', 'url' => '/customer-ledger-search-data', 'role' => 'search'])  !!}
                                                            <div class="row" style="margin-top: -8px;">
                                                                <div class="col-md-5">
                                                                    <input type="date" class="form-control" name="from" required="">
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <input type="date" class="form-control" name="to" required="">
                                                                </div>
                                                                <input type="hidden" name="customer_id" value="{{ $supplier->id }}">
                                                                <div class="col-md-2">
                                                                <span class="input-group-append">
                                                                    <button class="btn btn-secondary" type="submit">
                                                                        <i class="fa fa-search"></i>
                                                                    </button>
                                                                </span>
                                                                </div>
                                                            </div>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th>SL.</th>
                                                                <th>Date</th>
                                                                <th>Purchase</th>
                                                                <th>Quantity</th>
                                                                <th>Purchase Amount</th>
                                                                <th>Paid Amount</th>
                                                                <th>Due Amount</th>
                                                                <th>Balance</th>
                                                                <th>Note</th>
                                                                <th>Receipt By</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
{{--                                                            @php--}}
{{--                                                                $i = 1;--}}
{{--                                                                $gtotal = 0;--}}
{{--                                                                $pgtotal = 0;--}}
{{--                                                                $sgtotal = 0--}}
{{--                                                            @endphp--}}
{{--                                                            @if(isset($suppler))--}}
{{--                                                                @foreach($result as $key2 => $item)--}}
{{--                                                                    @php--}}
{{--                                                                        $gtotal = $gtotal;--}}
{{--                                                                    @endphp--}}
{{--                                                                    <tr>--}}
{{--                                                                        <td style="width: 1%;"> {{$key2+1}}</td>--}}
{{--                                                                        <td style="width: 11%;">--}}
{{--                                                                            {{ Carbon\Carbon::parse($item['created_at'])->format('d-m-Y') }}--}}
{{--                                                                        </td>--}}
{{--                                                                        <td>--}}
{{--                                                                            @if($item['ivno'])--}}
{{--                                                                                <a href="{{ url('/invoices-print/'.$item['ivno'] ) }}" style="cursor: pointer;"> {{ $item['ivno'] }}</a>--}}
{{--                                                                            @endif --}}
{{--                                                                        </td>--}}
{{--                                                                        <td style="width: 10%;">{{ $item['quantuty'] }}</td>--}}
{{--                                                                        <td style="width: 14%;">{{ $item['balance'] }}</td>--}}
{{--                                                                        <td style="width: 15%;">{{ $item['ramount'] }}</td>--}}
{{--                                                                        <td style="width: 12%;">{{ $item['damount'] }}</td>--}}
{{--                                                                        @php--}}

{{--                                                                            if($item['type'] == 'payments'){--}}
{{--                                                                             $sgtotal = $sgtotal + $item['lamount'];--}}
{{--                                                                            }--}}
{{--                                                                            if(($item['type'] == 'customer') || ($item['type'] == 'invoice') ){--}}
{{--                                                                             $pgtotal = $pgtotal + $item['lamount'];--}}
{{--                                                                            }--}}
{{--                                                                            $gtotal = $pgtotal - $sgtotal;--}}
{{--                                                                        @endphp--}}
{{--                                                                        <td style="width: 12%;">{{$gtotal}}</td>--}}
{{--                                                                        <td>{{ $item['notebar'] }}</td>--}}
{{--                                                                        @php--}}
{{--                                                                            $user = App\User::where('id',$item['user_id'])->first();--}}
{{--                                                                        @endphp--}}
{{--                                                                        @if($item['user_id'])--}}
{{--                                                                            <td style="width: 10%;">{{$user->name}} </td>--}}
{{--                                                                        @else--}}
{{--                                                                            <td style="width: 10%;"> </td>--}}
{{--                                                                        @endif--}}
{{--                                                                    </tr>--}}
{{--                                                                    @php--}}
{{--                                                                        $i++;--}}
{{--                                                                    @endphp--}}
{{--                                                                @endforeach--}}
{{--                                                            @endif--}}
{{--                                                            @if(isset($invoices))--}}

{{--                                                                <?php--}}
{{--                                                                $grand_total_price = $invoices->sum('grand_total_price');--}}
{{--                                                                $advanced_amount = $invoices->sum('advanced');--}}
{{--                                                                $total_advanced_amount = $advanced_amount+$total_payment_amount;--}}
{{--                                                                $due_amount = $grand_total_price+$customer->due-$total_advanced_amount;--}}
{{--                                                                $quantity = $invoices->sum('total_quantity');--}}
{{--                                                                if($customer->quantity != null){--}}
{{--                                                                    $total_quantity = $quantity+$customer->quantity;--}}
{{--                                                                }else{--}}
{{--                                                                    $total_quantity = $invoices->sum('total_quantity');--}}
{{--                                                                }--}}

{{--                                                                ?>--}}
{{--                                                                <tr>--}}
{{--                                                                    <td colspan="3" class="text-right">Total</td>--}}
{{--                                                                    <td>{{ $total_quantity }}</td>--}}
{{--                                                                    <td>{{ $grand_total_price }}</td>--}}
{{--                                                                    <td>{{ $total_advanced_amount }}</td>--}}
{{--                                                                    <td>{{ $due_amount }}</td>--}}
{{--                                                                    <td></td>--}}
{{--                                                                    <td></td>--}}
{{--                                                                </tr>--}}
{{--                                                            @endif--}}
                                                            </tbody>
                                                        </table>
{{--                                                        @if(isset($customer->id))--}}
{{--                                                            <div class="col-md-4 col-md-offset-4">--}}
{{--                                                                <a href="{{ url('/customer-ledger-print/'.$customer->id) }}" class="btn btn-primary btn-block"><i class="fa fa-print"></i> Print</a>--}}
{{--                                                            </div>--}}
{{--                                                        @endif--}}
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

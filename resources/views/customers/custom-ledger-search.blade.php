@extends('layouts.app')
@section('title')
Customers Ledgers
@endsection
@section('header-script')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div id="page-wrapper">
    <div class="main-page">
        @include('layouts.include.alert')
        <div class="forms">
            <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                <div class="form-title">
                    <h4>Customer Ledger</h4>
                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::open(['method' => 'GET', 'url' => '/customer-ledger-search-data', 'role' => 'search'])  !!}
                            <div class="row"> 
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="customer_id" placeholder="Customer Id..." value="{{ request('customer_id') }}">
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control" name="customer_name" id="customer_id">
                                        <option value="">Select Customer</option>
                                        @foreach($custom as $key=>$value)
                                            <option value="{{ $value  }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="submit">
                                            <i class="fa fa-search"></i> Search
                                        </button>
                                    </span>
                                </div>
                            </div>
                            {!! Form::close() !!}

                            <br/>
                            <br/>
                            <br/>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Date</th>
                                            <th>Invoice No</th>
                                            <th>Quantity</th>
                                            <th>Invoice Amount</th>
                                            <th>Recived Amount</th>
                                            <th>Due Amount</th>
                                            <th>Note</th>
                                            <th>Receipt By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($invoices))
                                            @foreach($invoices as $row)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td> 
                                                        {{ Carbon\Carbon::parse($row->created_at)->format('d-m-Y') }}
                                                    </td>
                                                    <td>{{ $row->invoice_id }}</td>
                                                    <td>{{ $row->total_quantity }}</td>
                                                    <td>{{ $row->grand_total_price }}</td>
                                                    <td>{{ $row->advanced }}</td>
                                                    <td>{{ $row->due_amount }}</td>
                                                    <td>{{ $row->notebar }}</td>
                                                    @php
                                                        $user = App\User::where('id',$row->user_id)->first();
                                                    @endphp
                                                    <td>{{ $user->getRoleNames() }}</td>
                                                </tr>
                                            @endforeach
                                            @foreach($payments as $item)
                                            <tr>
                                                <td></td>
                                                <td> 
                                                    {{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $item->amount }}</td>
                                                <td></td>
                                                <td>{{ $item->notebar }}</td>
                                                @php
                                                    $user = App\User::where('id',$item->user_id)->first();
                                                @endphp
                                                <td>{{ $user->getRoleNames() }}</td>
                                            </tr>
                                            @endforeach

                                            <?php
                                              $grand_total_price = $invoices->sum('grand_total_price');
                                              $advanced_amount = $invoices->sum('advanced');
                                              $total_advanced_amount = $advanced_amount+$total_payment_amount;
                                              $due_amount = $grand_total_price-$total_advanced_amount;
                                            ?>
                                            <tr>
                                                <td colspan="4" class="text-right">Total Amount</td>
                                                <td>{{ $grand_total_price }}</td>
                                                <td>{{ $total_advanced_amount }}</td>
                                                <td>{{ $due_amount }}</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                @if(isset($customerId))
                                    <div class="col-md-4 col-md-offset-4">
                                        <a href="{{ url('/customer-ledger-print/'.$customerId) }}" class="btn btn-primary btn-block"><i class="fa fa-print"></i> Print</a>
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
@endsection
@section('footer-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    $('#customer_id').select2();
</script>
 
@endsection
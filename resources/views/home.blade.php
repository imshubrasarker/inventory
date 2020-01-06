@extends('layouts.app')
@section('title')
Home
@endsection
@section('header-script')
<link rel="stylesheet" type="text/css" href="{{ asset('back/css/home.css') }}">
@endsection
@section('content')
<div id="page-wrapper">
@hasrole('Admin')
  <div class="row">
    <div class="col-md-3">
      <div class="card-counter primary">
        <i class="fa fa-code-fork"></i>
        <span class="count-name">Today Invoice: {{ $today_invoice }}</span>
        <span class="count-name-total">Total Invoice: {{ $total_invoice }}</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter danger">
        <i class="fa fa-ticket"></i>
        <span class="count-name">Today Customer: {{ $today_customer }}</span>
        <span class="count-name-total">Total Customer: {{ $total_customer }}</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter success">
        <i class="fa fa-database"></i>
        <span class="count-name">Today Product: {{ $today_product }}</span>
        <span class="count-name-total">Total Product: {{ $total_product }}</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter info">
        <i class="fa fa-users"></i>
        <span class="count-name">Today Sale: {{ $today_sale_amount }}</span>
        <span class="count-name-total">Total Sale: {{ $total_sale_amount }}</span>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-3">
      <div class="card-counter primary">
        <i class="fa fa-code-fork"></i>
        <span class="count-name"></span>
        <span class="count-name-total">Total Stock: {{ $total_stock }}</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter danger">
        <i class="fa fa-code-fork"></i>
        <span class="count-name"></span>
        <span class="count-name-total">Total Due: {{ $total_due }}</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter danger">
        <i class="fa fa-code-fork"></i>
        <span class="count-name"></span>
        <span class="count-name-total">Total Stock Value: {{ $total_stock_value }}</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter danger">
        <i class="fa fa-code-fork"></i>
        <span class="count-name">Expense Today : {{ $total_expenses_today }} </span>
        <span class="count-name-total">Total Expenses: {{ $total_expenses }}</span>
      </div>
    </div>
  </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card-counter danger">
                <i class="fa fa-code-fork"></i>
                <span class="count-name">Today Supplier: {{ $today_supplier ? count($today_supplier) : 0 }}</span>
                <span class="count-name-total">Total Supplier: {{ $total_spplier ? count($total_spplier) : 0 }}</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-counter danger">
                <i class="fa fa-code-fork"></i>
                <span class="count-name">Today Purchase: {{ $today_purchase  }}</span>
                <span class="count-name-total">Total Purchase: {{ $total_purchase }}</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-counter success">
                <i class="fa fa-code-fork"></i>
                <span class="count-name">Today Received: {{ $rPayment  }}</span>
                <span class="count-name-total">Total Received: {{ $rPaymentTotal }}</span>
            </div>
        </div>
    </div>

<div class="main-page">
  <div class="row">
    <div class="col-md-12">
      <div class="forms">
        <div class="form-grids row widget-shadow" data-example-id="basic-forms">
            <div class="form-title">
                <h4>Invoices</h4>
            </div>
            <div class="form-body">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Invoice No</th>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($invoices as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->invoice_id }}</td>
                                        <td>{{ $item->manual_date }}</td>
                                        <td>
                                            @if(isset($customers[$item->customer_id]))
                                        {{ $customers[$item->customer_id] }}
                                        @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('/invoices/' . $item->id) }}" title="View Invoice"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            @if($loop->iteration == 1)
                                                <a href="{{ url('/invoices/' . $item->id . '/edit') }}" title="Edit Invoice"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            @endif
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/invoices', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete Invoice',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
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
</div>


<div class="main-page">
  <div class="row">
    <div class="col-md-12">
      <div class="forms">
        <div class="form-grids row widget-shadow" data-example-id="basic-forms">
            <div class="form-title">
                <h4>Sales</h4>
            </div>
            <div class="form-body">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                      <th>Today</th>
                                      <td>{{ $today_sale_amount }}</td>
                                    </tr>
                                    <tr>
                                      <th>Last 7 Days</th>
                                      <td>{{ $seven_days_sale }}</td>
                                    </tr>
                                    <tr>
                                      <th>Last 30 Days</th>
                                      <td>{{ $thirty_days_sale }}</td>
                                    </tr>
                                    <tr>
                                      <th>Last 6 Months</th>
                                      <td>{{ $six_months_sale }}</td>
                                    </tr>
                                    <tr>
                                      <th>Last 1 Year</th>
                                      <td>{{ $one_year_sale }}</td>
                                    </tr>
                                    <tr>
                                      <th>Total</th>
                                      <td>{{ $total_sale_amount }}</td>
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
</div>
@else
    <h4>You have not permission this page.</h4>

@endhasrole
</div>

@endsection



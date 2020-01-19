@extends('layouts.app')
@section('title')
Invoices
@endsection
@section('header-script')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('back/css/print.css') }}">

@endsection
@section('content')
<div id="page-wrapper">
    <div class="main-page">
        @include('layouts.include.alert')
        <div class="forms">
            <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                <div class="form-title">
                    <h4>Manage Invoice</h4>
                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::open(['method' => 'GET', 'url' => '/invoices', 'role' => 'search'])  !!}
                            <div class="row">
                                <div class="col-md-2">
                                    <select class="form-control" name="customer_id" id="customer_id">
                                        <option value="">Select Customer</option>
                                        @foreach($customers as $key=>$value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <select class="form-control" name="customer_mobile" id="customer_mobile">
                                        <option value="">Select Mobile</option>
                                        @foreach($customer_mobiles as $key=>$value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group date" data-date-format="yyyy.mm.dd">
                                      <input  type="text" name="from" class="form-control" placeholder="dd.mm.yyyy">
                                      <div class="input-group-addon" >
                                        <span class="glyphicon glyphicon-th"></span>
                                      </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group date" data-date-format="yyyy.mm.dd">
                                      <input  type="text" name="to" class="form-control" placeholder="dd.mm.yyyy">
                                      <div class="input-group-addon" >
                                        <span class="glyphicon glyphicon-th"></span>
                                      </div>
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
                            {!! Form::close() !!}
                            <br/>
                            <br/>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr style="color: #00a78e; ">
                                            <th> <i class="fa fa-list-ol" aria-hidden="true"></i>  Sl</th>
                                            <th><i class="fa fa-calendar" aria-hidden="true"></i>  Date</th>
                                            <th><i class="fa fa-file-text" aria-hidden="true"></i>  Invoice</th>
                                            <th><i class="fa fa-certificate" aria-hidden="true"></i>  Customer Name</th>
                                            <th><i class="fa fa-map-o" aria-hidden="true"></i>  Address</th>
                                            <th><i class="fa fa-money" aria-hidden="true"></i>  Amount</th>
                                            <th><i class="fa fa-tasks" aria-hidden="true"></i>  Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($invoices as $key=>$item)
                                        @if($loop->first)
                                            @php
                                                $start_serial = $key + $invoices->firstItem();
                                            @endphp
                                        @endif
                                        <tr>
                                            <td style="width: 1%;">{{ $key + $invoices->firstItem() }}</td>
                                            <td style="width: 11%; word-break: break-all;">
                                                {{ $item->manual_date }}
                                            </td>
                                            <td>
                                                <a href="{{ url('/invoices/' . $item->id) }}"style="cursor: pointer;">
                                                    {{ $item->invoice_id }}
                                                </a>
                                            </td>
                                            <td style="width: 20%;">
                                                @if(isset($customer_name[$item->customer_id]))
                                                    {{ $customer_name[$item->customer_id] }}
                                                @endif
                                            </td>
                                            <td style="width: 20%;">
                                                @if(isset($customer_address[$item->customer_id]))
                                                    {{ $customer_address[$item->customer_id] }}
                                                @endif
                                            </td>
                                            <td>{{ $item->grand_total_price }}</td>
                                            <td>
                                                <a href="{{ url('/invoices/' . $item->id) }}" title="View Invoice"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                                @if($loop->iteration == 1)
                                                    <a href="{{ url('/invoices/' . $item->id . '/edit') }}" title="Edit Invoice"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                                @endif
                                                @hasrole('Admin')
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#invoicedelete-{{ $item->id }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Delete</button>

                                                <div id="invoicedelete-{{ $item->id }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Delete Invoice</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! Form::open([
                                                                    'method'=>'DELETE',
                                                                    'url' => ['/invoices', $item->id],
                                                                    'class' => 'form-horizontal'
                                                                ]) !!}

                                                                    <div class="form-group">
                                                                        <label for="Role" class="control-label col-md-2">Password</label>
                                                                        <div class="col-md-10">
                                                                            <input type="password" class="form-control" name="password" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="Role" class="form-control-label col-md-2"></label>
                                                                        <div class="col-md-10">
                                                                            <button class="btn btn-primary" type="submit">Submit</button>
                                                                        </div>
                                                                    </div>

                                                                {!! Form::close() !!}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                @endhasrole
                                                {{-- {!! Form::open([
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
                                                {!! Form::close() !!} --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5" style="text-align: right;">Total</td>
                                        <td style="text-align: right;">{{ $invoices->sum('grand_total_price') }}</td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="pagination-wrapper"> {!! $invoices->appends(['search' => Request::get('search')])->render() !!} </div>
                            </div>
                            <br/>
                            @if($invoices[0])
                            <a href="{{ url('/list-print?first_id='. $invoices[count($invoices)-1]->id .'&last_id=' . $invoices[0]->id . '&start_serial=' . $start_serial) }}" class="btn btn-sm btn-primary btn-block"><i class="fa fa-file-pdf-o"></i> Print</a>
                              @endif
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
    $('.input-group.date').datepicker({format: "yyyy.mm.dd"});
    $('#customer_id').select2();
    $('#customer_mobile').select2();
</script>

@endsection

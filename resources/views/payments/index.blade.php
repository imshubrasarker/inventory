@extends('layouts.app')
@section('title')
Payments
@endsection
@section('header-script')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div id="page-wrapper">
    <div class="main-page">
        @include('layouts.include.alert')
        <div class="forms">
            <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                <div class="form-title">
                    <h4>Manage Payment</h4>
                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::open(['method' => 'GET', 'url' => '/payments', 'role' => 'search'])  !!}
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
                                      <input  type="text" name="from" class="form-control">
                                      <div class="input-group-addon" >
                                        <span class="glyphicon glyphicon-th"></span>
                                      </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group date" data-date-format="yyyy.mm.dd">
                                      <input  type="text" name="to" class="form-control">
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
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Customer</th>
                                            <th>Date</th>
                                            <th>Mobile No</th>
                                            <th>Amount</th>
                                            <th>Note</th>
                                            <th>Receipt By</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $start_serial = 0;
                                            $total = 0;
                                        @endphp
                                    @foreach($payments as $key=>$item)
                                        @if ($item->customer_id)
                                            @php
                                                $total = $total + $item->amount;
                                            @endphp
                                            @if($loop->first)
                                                @php
                                                    $start_serial = $key + $payments->firstItem();
                                                @endphp
                                            @endif
                                            <tr>
                                                <td style="width: 1%;">{{ $key + $payments->firstItem() }}</td>
                                                <td style="width: 15%;">
                                                    @if(isset($customers[$item->customer_id]))
                                                        {{ $customers[$item->customer_id] }}
                                                    @endif
                                                </td>
                                                <td style="width: 11%;">
                                                    {{ Carbon\Carbon::parse($item->manual_date)->format('d-m-Y') }}
                                                </td>
                                                <td>{{ "0".$item->mobile_no }}</td>
                                                <td style="width: 12%;">{{ $item->amount }}</td>
                                                <td style="width: 13%; word-break: break-all;">{{ $item->notebar }}</td>
                                                @php
                                                    $user = App\User::where('id',$item->user_id)->first();
                                                @endphp
                                                <td style="width: 12%;">{{ $user['name'] }}</td>
                                                <td>
                                                    <a href="{{ url('/payments/' . $item->id) }}" title="View Payment"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                                    <a href="{{ url('/payments/' . $item->id . '/edit') }}" title="Edit Payment"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#paymentdelete-{{ $item->id }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Delete</button>

                                                    <div id="paymentdelete-{{ $item->id }}" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">

                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title">Delete Payments</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    {!! Form::open([
                                                                        'method'=>'DELETE',
                                                                        'url' => ['/payments', $item->id],
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



                                                    {{-- {!! Form::open([
                                                        'method'=>'DELETE',
                                                        'url' => ['/payments', $item->id],
                                                        'style' => 'display:inline'
                                                    ]) !!}
                                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                                'type' => 'submit',
                                                                'class' => 'btn btn-danger btn-sm',
                                                                'title' => 'Delete Payment',
                                                                'onclick'=>'return confirm("Confirm delete?")'
                                                        )) !!}
                                                    {!! Form::close() !!} --}}

                                                    <a href="{{ url('/payment-sms/'.$item->id) }}" class="btn btn-sm btn-dark">
                                                        <i class="fa fa-paper-plane"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    <tr>
                                        <td colspan="4" style="text-align: right;">Total Amount</td>
                                        <td>{{ $total }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="pagination-wrapper"> {!! $payments->appends(['search' => Request::get('search')])->render() !!} </div>
                            </div>
                            <br>
                            <a href="{{ url('/payment-list-print?first_id='. $payments[count($payments)-1]['id'] .'&last_id=' . $payments[0]['id'] . '&start_serial=' . $start_serial) }}" class="btn btn-sm btn-primary btn-block"><i class="fa fa-file-pdf-o"></i> Print</a>
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

@extends('layouts.app')
@section('title')
Customers
@endsection
@section('header-script')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
 <style>
    .clearfix:after {
        content: "";
        display: table;
        clear: both;
    }
    
    a {
        color: #0087C3;
        text-decoration: none;
    }
 

    
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
        height: 75px;
    }
    
    #company {
        float: right;
        text-align: right;
    }
    
    #details {
        margin-bottom: 50px;
    }
    
    #client {
        padding-left: 6px;
        border-left: 6px solid #0087C3;
        float: left;
    }
    
    #client .to {
        color: #777777;
    }
    
    h2.name {
        font-size: 15px;
        font-weight: normal;
        margin: 0;
        font-weight: bold;
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
    
    table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        border: 1px solid black;
        ;
        margin-bottom: 20px;
    }
    
    table th,
    table td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 5px;
        background: #EEEEEE;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
    }
    
    table th {
        border: 1px solid black;
        border-collapse: collapse;
        white-space: nowrap;
        font-weight: normal;
    }
    
    table td {
        border: 1px solid black;
        border-collapse: collapse;
        text-align: right;
    }
    
    table td h3 {
        border: 1px solid black;
        border-collapse: collapse;
        color: #57B223;
        font-size: 1.2em;
        font-weight: normal;
        margin: 0 0 0.2em 0;
    }
    
    table .no {
        color: #FFFFFF;
        font-size: 12px;
        background: #57B223;
    }
    
    table .desc {
        text-align: left;
    }
    
    table .unit {
        background: #DDDDDD;
    }
    
    table .qty {}
    
    table .total {
        background: #57B223;
        color: #FFFFFF;
    }
    
    table td.unit,
    table td.qty,
    table td.total {
        font-size: 1.2em;
    }
    
    table tbody tr:last-child td {
        border: none;
    }
    
    table tfoot td {
        padding: 10px 20px;
        background: #FFFFFF;
        border-bottom: none;
        font-size: 1.2em;
        white-space: nowrap;
        border-top: 1px solid #AAAAAA;
    }
    
    table tfoot tr:first-child td {
        border-top: none;
    }
    
    table tfoot tr:last-child td {
        color: #57B223;
        font-size: 1.4em;
        border-top: 1px solid #57B223;
    }
    
    table tfoot tr td:first-child {
        border: none;
    }
    
    #thanks {
        font-size: 2em;
        margin-bottom: 50px;
    }
    
    #notices {
        padding-left: 6px;
        border-left: 6px solid #0087C3;
    }
    
    #notices .notice {
        font-size: 1.2em;
    }
    
    footer {
        color: #777777;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #AAAAAA;
        padding: 8px 0;
        text-align: center;
    }
</style>
@endsection
@section('content')
<div id="page-wrapper">
    <div class="main-page">
        @include('layouts.include.alert')
        <div class="forms">
            <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                <div class="form-title">
                    <h4 class="float-left"> Manage Customer</h4>
                    <h4 class="float-right"> <font color="red">Total Due: {{ $total_due }}</font></h4>
                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::open(['method' => 'GET', 'url' => '/customers', 'role' => 'search'])  !!}
                            <div class="row"> 
                                <div class="col-md-4">
                                    <select class="form-control" name="customer_id" id="customer_id">
                                        <option value="">Select Customer</option>
                                        @foreach($customer as $key=>$value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control" name="customer_mobile" id="customer_mobile">
                                        <option value="">Select Mobile</option>
                                        @foreach($customer_mobiles as $key=>$value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            {!! Form::close() !!}
                            <div class="table-responsive" style="overflow-x:auto;">
                                <table style="width: 100%;" class="table table-bordered table-responsive table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL No</th>
                                            <th>Image</th>
                                            <th >Name</th>
                                            <th>Mobile No</th>
                                            <th>Due Balance</th>
                                            <th>Address</th>
                                            <th>Note</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $sumdues = 0
                                        @endphp
                                    @foreach($customers as $key=>$item)
                                        @if($loop->first)
                                            @php
                                                $start_serial = $key + $customers->firstItem();
                                            @endphp
                                        @endif
                                        <tr>
                                            <td>{{ $key + $customers->firstItem() }}</td>
                                            <td>
                                                @if($item->image != null)
                                                    <img src="{{ asset($item->image) }}" alt="" style="width: 80px; height: 80px;">
                                                @else
                                                    <img src="{{ asset('customer_image/img_avatar3.png') }}" alt="" style="width: 80px; height: 80px;">
                                                @endif
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->primary_mobile }}</td>
                                            <td>
                                                @php
                                                $customer_due = App\Customer::findOrFail($item->id);
                                                $invoices = App\Invoice::where('customer_id',$item->id)->latest()->orderBy('id')->get();
                                                $payments = App\Payment::where('customer_id',$item->id)->latest()->get();
                                        		$total_payment_amount = $payments->sum('amount');
		
                                                $grand_total_price = $invoices->sum('grand_total_price');
                                                $paid_price = $invoices->sum('advanced')+$total_payment_amount;
                                                $due_amount = $grand_total_price+$customer_due->due-$paid_price;
                                                $sumdues +=$due_amount;
                                                @endphp 
                                                @if($grand_total_price > $paid_price)
                                                    <p> {{$due_amount }}TK</p>
                                                @else
                                                    <p> {{ $due_amount }}TK </p>
                                                @endif  
                                            </td>
                                            <td>{{ $item->address }}</td>
                                            <td>
                                                @if($item->note != null)
                                                    {{ $item->note }}
                                                @else
                                                    {{ 'Not add note' }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('/customers/' . $item->id) }}" title="View Customer"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> </button></a>
                                                @hasrole('Admin')
                                                <a href="{{ url('/customers/' . $item->id . '/edit') }}" title="Edit Customer"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button></a>
                                                @endhasrole
                                                @hasrole('Admin')
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#customerdelete-{{ $item->id }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button>

                                                <div id="customerdelete-{{ $item->id }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Delete Customer</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! Form::open([
                                                                    'method'=>'DELETE',
                                                                    'url' => ['/customers', $item->id],
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
                                                    'url' => ['/customers', $item->id],
                                                    'style' => 'display:inline'
                                                ]) !!}
                                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                            'type' => 'submit',
                                                            'class' => 'btn btn-danger btn-sm',
                                                            'title' => 'Delete Customer',
                                                            'onclick'=>'return confirm("Confirm delete?")'
                                                    )) !!}
                                                {!! Form::close() !!} --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4" style="text-align: right;">Total Due:</td>
                                        <td> {{$sumdues}}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="pagination-wrapper"> {!! $customers->appends(['search' => Request::get('search')])->render() !!} </div>
                            </div>
                            <br>
                            @if($customers[0])
                            <a href="{{ url('/customer-list-print?first_id='. $customers[count($customers)-1]->id .'&last_id=' . $customers[0]->id . '&start_serial=' . $start_serial) }}" class="btn btn-sm btn-primary btn-block"><i class="fa fa-file-pdf-o"></i> Print</a>
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
<script type="text/javascript">
    $('#customer_id').select2();
    $('#customer_mobile').select2();
</script>

@endsection
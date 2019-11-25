@extends('layouts.app')
@section('title')
Stocks
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
                    <h4>Manage Stock</h4>
                </div>
                <div class="form-body">
                    <div class="card"> 
                        <div class="card-body">
                            {!! Form::open(['method' => 'GET', 'url' => '/stocks', 'role' => 'search'])  !!}
                            <div class="row"> 
                                <div class="col-md-4">
                                    <select class="form-control" name="product_id" id="product_id">
                                        <option value="">Select Product</option>
                                        @foreach($products as $key=>$value)
                                            <option value="{{ $value->product_id }}">{{ $value->name }} ({{ $value->size }})</option>
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
                            @hasrole('Admin')
                            <a href="{{ url('/stocks/create') }}" class="btn btn-success btn-sm" title="Add New Stock">
                                <i class="fa fa-plus" aria-hidden="true"></i> Add New
                            </a>
                            @endhasrole
                            <br/>
                            <br/>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th width="25%">Product</th>
                                            <th width="15%">Size</th>
                                            <th>Available Stock</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($stocks as $key=>$item)
                                        @if($loop->first)
                                            @php
                                                $start_serial = $key + $stocks->firstItem();
                                            @endphp
                                        @endif
                                        @if($item->product_stock <= $item->alert_quantity)
                                        <tr style="background-color: #7a0909;">
                                            
                                                <td style="width: 1%; color: white;">
                                                    {{ $key + $stocks->firstItem()  }}
                                                </td>
                                                <td>
                                                    <a href="{{ url('/product-ledger/'.$item->product_id) }}" class="btn btn-sm btn-success">
                                                        {{ $item->name }}
                                                    </a>
                                                </td>
                                                <td style="width: 10%; color: white;">{{ $item->size }}</td>
                                                <td style="color: white;">{{ $item->product_stock }}</td>
                                            

                                            
                                            <td>
                                                <a href="{{ url('/product-ledger/'.$item->product_id) }}" title="Product {{ $item->name }} Ledger"><button class="btn btn-success btn-sm"><i class="fa fa-list-alt" aria-hidden="true"></i> Ledger</button></a>

                                                @hasrole('Admin')
                                                <a href="{{ url('/stocks/' . $item->id) }}" title="View Stock"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>

                                                <a href="{{ url('/stocks/' . $item->id . '/edit') }}" title="Edit Stock"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#stockdelete-{{ $item->id }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Delete</button>

                                                <div id="stockdelete-{{ $item->id }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Delete Stock</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! Form::open([
                                                                    'method'=>'DELETE',
                                                                    'url' => ['/stocks', $item->id],
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
                                                    'url' => ['/stocks', $item->id],
                                                    'style' => 'display:inline'
                                                ]) !!}
                                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                            'type' => 'submit',
                                                            'class' => 'btn btn-danger btn-sm',
                                                            'title' => 'Delete Stock',
                                                            'onclick'=>'return confirm("Confirm delete?")'
                                                    )) !!}
                                                {!! Form::close() !!} --}}
                                            </td>
                                        </tr>
                                        @else

                                            <tr>
                                            
                                                <td style="width: 1%;"> {{ $key + $stocks->firstItem()  }} </td>
                                                <td>
                                                    <a href="{{ url('/product-ledger/'.$item->product_id) }}" class="btn btn-sm btn-success">
                                                        {{ $item->name }}
                                                    </a>
                                                </td>
                                                <td style="width: 1%;">{{ $item->size }}</td>
                                                <td>{{ $item->product_stock }}</td>
                                            

                                            
                                            <td>
                                                <a href="{{ url('/product-ledger/'.$item->product_id) }}" title="Product {{ $item->name }} Ledger"><button class="btn btn-success btn-sm"><i class="fa fa-list-alt" aria-hidden="true"></i> Ledger</button></a>

                                                @hasrole('Admin')
                                                <a href="{{ url('/stocks/' . $item->id) }}" title="View Stock"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                                <a href="{{ url('/stocks/' . $item->id . '/edit') }}" title="Edit Stock"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#stockdelete-{{ $item->id }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Delete</button>

                                                <div id="stockdelete-{{ $item->id }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Delete Stock</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! Form::open([
                                                                    'method'=>'DELETE',
                                                                    'url' => ['/stocks', $item->id],
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
                                                    'url' => ['/stocks', $item->id],
                                                    'style' => 'display:inline'
                                                ]) !!}
                                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                            'type' => 'submit',
                                                            'class' => 'btn btn-danger btn-sm',
                                                            'title' => 'Delete Stock',
                                                            'onclick'=>'return confirm("Confirm delete?")'
                                                    )) !!}
                                                {!! Form::close() !!} --}}
                                            </td>
                                        </tr>

                                        @endif
                                    @endforeach
                                    <tr>
                                        <td colspan="3" style="text-align: right;">Total</td>
                                        <td style="text-align: right">{{ $stocks->sum('product_stock') }}</td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="pagination-wrapper"> {!! $stocks->appends(['search' => Request::get('search')])->render() !!} </div>
                            </div>
                            <br/>
                            <a href="{{ url('/stock-list-print?first_id='. $stocks[count($stocks)-1]->id .'&last_id=' . $stocks[0]->id . '&start_serial=' . $start_serial) }}" class="btn btn-sm btn-primary btn-block"><i class="fa fa-file-pdf-o"></i> Print</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-script')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">
    $('#stocks_id').select2();
    $('#product_id').select2();
    
</script>

@endsection
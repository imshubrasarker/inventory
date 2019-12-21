@extends('layouts.app')
@section('title')
    Godown 3
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
                        <h4>Godown 3</h4>
                    </div>
                    <div class="form-body">
                        <div class="card">
                            <div class="card-body">
                                {!! Form::open(['method' => 'GET', 'url' => '/godown-3', 'role' => 'search'])  !!}
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

                                                        @hasrole('Admin')
                                                        <a href="{{ url('/stocks/' . $item->id) }}" title="View Stock"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
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

                                                        @hasrole('Admin')
                                                        <a href="{{ url('/stocks/' . $item->id) }}" title="View Stock"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>

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

                                        </tbody>
                                    </table>
                                    <div class="pagination-wrapper"> {!! $stocks->appends(['search' => Request::get('search')])->render() !!} </div>
                                </div>
                                <br/>
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
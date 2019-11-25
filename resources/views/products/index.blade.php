@extends('layouts.app')
@section('title')
Products
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
                    <h4>Manage Products</h4>
                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::open(['method' => 'GET', 'url' => '/products', 'role' => 'search'])  !!}
                            <div class="row"> 
                                <div class="col-md-4">
                                    <select class="form-control" name="product_id" id="product_id">
                                        <option value="">Select Product</option>
                                        @foreach($product as $key=>$value)
                                            <option value="{{ $key }}">{{ $value }}</option>
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
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Name</th>
                                            <th>Size</th>
                                            <th>Buy Price</th>
                                            <th>Sale Price</th>
                                            <th>Discount</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $key=>$item)
                                        @if($loop->first)
                                            @php
                                                $start_serial = $key + $products->firstItem();
                                            @endphp
                                        @endif
                                        <tr>
                                            <td>{{ $key + $products->firstItem() }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->size }}</td>
                                            <td>{{ $item->buy_price }}</td>
                                            <td>{{ $item->sale_price }}</td>
                                            <td>{{ $item->discount }}</td>
                                            <td>
                                               
                                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addStock-{{ $item->id }}"><i class="fa fa-plus" aria-hidden="true"></i> Add Stock</button>

                                                <!-- The Modal -->
                                                <div class="modal fade" id="addStock-{{ $item->id }}">
                                                  <div class="modal-dialog">
                                                    <div class="modal-content">

                                                      <!-- Modal Header -->
                                                      <div class="modal-header">
                                                        <h4 class="modal-title">Add Stock</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                      </div>

                                                      <!-- Modal body -->
                                                      <div class="modal-body">
                                                        <form action="{{ url('/stocks-add-update') }}" method="POST">
                                                            @csrf
                                                            <div class="form-group {{ $errors->has('product_stock') ? 'has-error' : ''}}">
                                                                {!! Form::label('product_stock', 'Product Stock', ['class' => 'control-label']) !!}
                                                                {!! Form::text('product_stock', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                                {!! $errors->first('product_stock', '<p class="help-block">:message</p>') !!}
                                                            </div>
                                                            <input type="hidden" name="product_id" value="{{ $item->id }}">
                                                            <div class="form-group">
                                                                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                                                            </div>
                                                        </form>
                                                      </div>

                                                      <!-- Modal footer -->
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                      </div>

                                                    </div>
                                                  </div>
                                                </div>
                                               
                                                <a href="{{ url('/products/' . $item->id) }}" title="View Product"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                                @hasrole('Admin')
                                                <a href="{{ url('/products/' . $item->id . '/edit') }}" title="Edit Product"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#productdelete-{{ $item->id }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Delete</button>

                                                <div id="productdelete-{{ $item->id }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Delete Product</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! Form::open([
                                                                    'method'=>'DELETE',
                                                                    'url' => ['/products', $item->id],
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
                                                    'url' => ['/products', $item->id],
                                                    'style' => 'display:inline'
                                                ]) !!}
                                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                            'type' => 'submit',
                                                            'class' => 'btn btn-danger btn-sm',
                                                            'title' => 'Delete Product',
                                                            'onclick'=>'return confirm("Confirm delete?")'
                                                    )) !!}
                                                {!! Form::close() !!} --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination-wrapper"> {!! $products->appends(['search' => Request::get('search')])->render() !!} </div>
                            </div>
                            <br>
                            <a href="{{ url('/product-list-print/?first_id='. $products[count($products)-1]->id .'&last_id=' . $products[0]->id . '&start_serial=' . $start_serial) }}" class="btn btn-sm btn-primary btn-block"><i class="fa fa-file-pdf-o"></i> Print</a>
                            
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
@extends('layouts.app')
@section('title')
    Manage Production
@endsection
@section('header-script')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="main-page">
            @include('layouts.include.alert')
            <div class="forms">
                <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                    <div class="form-title">
                        <h4>Manage Production</h4>
                    </div>
                    <div class="form-body">
                        <div class="card">
                            <div class="card-body">

                                <div style="overflow: hidden">
                                    <div class="float-left" style="float: left">
                                        <a href="{{ url('/home') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                                        <a href="{{ route('godown2.create') }}" class="btn btn-info btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>Add New</a>
                                        <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#exampleModal">
                                            <i class="fa fa-paper-plane" aria-hidden="true"></i> Transfer
                                        </button>
                                    </div>
{{--                                    <div class="float-right" style="float: right">--}}
{{--                                        <form class="navbar-form" role="search" action="{{ route('search.supplier') }}" method="get">--}}
{{--                                            @csrf--}}
{{--                                            <div class="input-group add-on">--}}
{{--                                                <input class="form-control" placeholder="Search" name="key" id="srch-term" type="text">--}}
{{--                                                <div class="input-group-btn">--}}
{{--                                                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
                                </div>

                                <br>
                                <br>

                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <form action="{{ route('production.search') }}" method="get">
                                            {{ method_field('get') }}
                                            {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-md-3">

                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control select2" name="product_id" id="product_id">
                                                        <option value="">Select Product</option>
                                                        @foreach($products as $key=> $value)
                                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control select2" name="product_size" id="product_size">
                                                        <option value="">Select Size</option>
                                                        @foreach($products as $key=>$value)
                                                            <option value="{{ $value->size }}">{{ $value->size }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-1">
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary btn-sm" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Size</th>
                                            <th scope="col">Color</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Note</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($productions as $supplier)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td>{{ $supplier->products->name }}</td>
                                            <td>{{ $supplier->size }}</td>
                                            <td>{{ $supplier->godownUnits->unit_name }}</td>
                                            <td>{{ $supplier->qty }}</td>
                                            <td>{{ $supplier->note }}</td>
                                            <td>{{ $supplier->date }}</td>
                                            <td>
                                               <div class="row">
                                                   <div class="col-md-3">
                                                       <a href="{{ route('godown2.show', $supplier->products->id) }}" type="button" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i> </a>
                                                   </div>
                                                   <div class="col-sm-3">
                                                       <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                                                               onclick="deleteHead('{{ route('godown2.destroy', $supplier->id) }}')">
                                                           <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                       </button>
                                                   </div>
                                               </div>
                                            </td>
                                        </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="pagination">
                                        {{ $productions->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Move product to Stocks</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-group" action="{{ route('move-to-stocks') }}" method="post">
                    @csrf
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="control-label  mb-2">Select Product <span class="text-danger">*</span></label>
                                <select class="form-control" name="product_id" id="product_id">
                                    <option value="">Select Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->size }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class=" col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="control-label mb-2">Number of Dozens <span class="text-danger">*</span></label>
                                <input type="number" placeholder="Number of Dozens" class="form-control" name="size" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @include('shared.delete-modal')
@endsection

@section('footer-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
        function deleteHead(route){
            $('#deleteForm').attr("action", route);
        }
    </script>
@endsection

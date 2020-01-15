@extends('layouts.app')
@section('title')
    Manage Suppliers
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
                        <h4>Manage Suppliers</h4>
                    </div>
                    <div class="form-body">
                        <div class="card">
                            <div class="card-body">

                                <div style="overflow: hidden">
                                    <div class="float-left" style="float: left">
                                        <a href="{{ url('/home') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <form action="{{ route('supplier.index') }}" method="get">
                                            {{ method_field('get') }}
                                            {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-md-3">

                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control select2" name="supplier_id" id="customer_id">
                                                        <option value="">Select Supplier</option>
                                                        @foreach($sup as $key=> $value)
                                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control select2" name="supplier_mobile" id="customer_mobile">
                                                        <option value="">Select Mobile</option>
                                                        @foreach($sup as $key=>$value)
                                                            <option value="{{ $value->mobile }}">{{ $value->mobile }}</option>
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


{{--                                @if (isset($total))--}}
{{--                                    <div style="overflow: hidden">--}}
{{--                                        <div style="float: right; margin-bottom: 10px">--}}
{{--                                            <h4>Total Balance: {{ $total }}</h4>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endif--}}
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Mobile</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Balance</th>
                                            <th scope="col">Note</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                          $total_balance = 0;
                                        @endphp
                                        @foreach($suppliers as $supplier)
                                            @php
                                                $total_balance = $total_balance + $supplier->balance;
                                            @endphp
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td>{{ $supplier->name }}</td>
                                            <td>{{ $supplier->mobile }}</td>
                                            <td width="15%">{{ $supplier->address }}</td>
                                            <td>{{ $supplier->balance }}</td>
                                            <td width="15%">{{ $supplier->note }}</td>
                                            <td>
                                               <div class="row">
                                                   <div class="col-md-3 text-center">
                                                       <a href="{{ route('supplier.leadger', $supplier->id) }}" class="btn-sm btn btn-info"><i class="fa fa-list-alt" aria-hidden="true"></i>Ledger</a>
                                                   </div>
                                                   <div class="col-sm-3 text-center">
                                                       <a href="{{ route('supplier.show', $supplier->id) }}" type="button" class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> </a>
                                                   </div>
                                                   <div class="col-md-3 text-center">
                                                       <a href="{{ route('supplier.edit', $supplier->id) }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                                   </div>
                                                   <div class="col-sm-3 text-center">
                                                       <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"
                                                               onclick="deleteHead('{{ route('supplier.destroy', $supplier->id) }}')">
                                                           <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                       </button>
                                                   </div>
                                               </div>
                                            </td>
                                        </tr>
                                            @endforeach
                                        <tr>
                                            <td colspan="4" class="text-right">Total</td>
                                            <td>{{ $total_balance }}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div>
                                        <a href="{{ route('supplier.print') }}" target="_blank" class="btn btn-primary btn-sm btn-block">Print</a>
                                    </div>
                                    <div class="pagination">
                                        {{ $suppliers->links() }}
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('shared.delete-modal')
@endsection

@section('footer-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();
        });
        function deleteHead(route){
            $('#deleteForm').attr("action", route);
        }
    </script>
@endsection

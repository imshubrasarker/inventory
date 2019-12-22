@extends('layouts.app')
@section('title')
    Manage Purchase
@endsection
@section('header-script')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="main-page">
            @include('layouts.include.alert')
            <div class="forms">
                <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                    <div class="form-title">
                        <h4>Manage Purchase</h4>
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
                                @if (isset($total))
                                    <div style="overflow: hidden">
                                        <div style="float: right; margin-bottom: 10px">
                                            <h4>Total Balance: {{ $total }}</h4>
                                        </div>
                                    </div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">SL</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Supplier Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Note</th>
                                            <th scope="col">Invoice</th>
                                            <th scope="col">Actions</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($purchases as $purchase)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td> {{ date('d-m-Y', strtotime($purchase->date)) }} </td>
                                            <td>{{ $purchase->supplier->name }}</td>
                                            <td>{{ $purchase->description }}</td>
                                            <td>{{ $purchase->quantity }}</td>
                                            <td>{{ $purchase->amount }}</td>
                                            <td>{{ $purchase->note }}</td>
                                            <td>{{ $purchase->invoice_num }}</td>
                                            <td>
                                               <div class="row">
                                                   <div class="col-sm-4">
                                                       <a href="{{ route('purchase.show', $purchase->id) }}" type="button" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i> </a>
                                                   </div>
                                                   <div class="col-md-4">
                                                       <a href="{{ route('purchase.edit', $purchase->id) }}" type="button" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                                   </div>
                                                   <div class="col-sm-4">
                                                       <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                                                               onclick="deleteHead('{{ route('purchase.destroy', $purchase->id) }}')">
                                                           <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                       </button>
                                                   </div>
                                               </div>
                                            </td>
                                        </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div>
                                        <a href="{{ route('purchase.print') }}" target="_blank" class="btn btn-primary btn-sm btn-block">Print</a>
                                    </div>
                                    <div class="pagination">
                                        {{ $purchases->links() }}
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
    <script>
        function deleteHead(route){
            $('#deleteForm').attr("action", route);
        }
    </script>
@endsection

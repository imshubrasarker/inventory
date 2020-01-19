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
                                        <tr style="color: #00a78e">
                                            <th scope="col"><i class="fa fa-list-ol" aria-hidden="true"></i>  SL</th>
                                            <th scope="col"><i class="fa fa-calendar" aria-hidden="true"></i>  Date</th>
                                            <th scope="col"><i class="fa fa-file-text" aria-hidden="true"></i>  Invoice</th>
                                            <th scope="col"><i class="fa fa-truck" aria-hidden="true"></i>  Supplier Name</th>
                                            <th scope="col"><i class="fa fa-list-alt" aria-hidden="true"></i>  Type</th>
                                            <th scope="col"><i class="fa fa-sticky-note-o" aria-hidden="true"></i>  Note</th>
                                            <th scope="col"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>  Quantity</th>
                                            <th scope="col"><i class="fa fa-money" aria-hidden="true"></i>  Amount</th>
                                            <th scope="col"><i class="fa fa-tasks" aria-hidden="true"></i>  Actions</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                        $total = 0;
                                        @endphp
                                        @foreach($purchases as $purchase)
                                            @php
                                            $total = $total + $purchase->amount;
                                            @endphp
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td> {{ date('d-m-Y', strtotime($purchase->date)) }} </td>
                                            <td>{{ $purchase->invoice_num }}</td>
                                            <td>{{ $purchase->supplier->name }}</td>
                                            <td>{{ $purchase->category['name'] }}</td>
                                            <td>{{ $purchase->note }}</td>
                                            <td>{{ $purchase->quantity }}</td>
                                            <td>{{ $purchase->amount }}</td>

                                            <td>
                                               <div class="row">
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
                                       <tr>
                                           <td class="text-right mr-4" colspan="6">Total amount</td>
                                           <td>{{ $total }}</td>
                                           <td></td>
                                           <td></td>
                                       </tr>
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

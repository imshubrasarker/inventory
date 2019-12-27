@extends('layouts.app')
@section('title')
    Supplier Details
@endsection
@section('header-script')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="main-page">
            <a href="{{ route('godown2.index') }}" title="Back">
                <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
            </a>
            {{--            <a href="{{ route('godown2.index', $supplier->id) }}" title="Edit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>--}}
            <br>
            <br>
            <form action="{{ route('ledger.search', $id) }}" method="get">
                @csrf
                <div class="col-md-3">
                    <div class="input-group date" data-date-format="yyyy.mm.dd">
                        <input type="text" name="from" class="form-control">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="input-group date" data-date-format="yyyy.mm.dd">
                        <input type="text" name="to" class="form-control">
                        <div class="input-group-addon">
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
            </form>
            @include('layouts.include.alert')
            <div class="panel">
                <div class="form-title bg-light ">
                    <h4><strong>Item Details </strong></h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Name</th>
                                <th scope="col">Size</th>
                                <th scope="col">Color</th>
                                <th scope="col">Add Quantity</th>
                                <th scope="col">Leave Quantity</th>
                                <th scope="col">Balance</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $total = 0;
                                $add_sum = 0;
                                $leave_sum = 0;
                            @endphp
                            @foreach($items as $item)
                                <tr>
                                    <td scope="row"> {{ $loop->index + 1  }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                    <td>{{ $item->godown2s->products->name }}</td>
                                    <td>{{ $item->godown2s->size }}</td>
                                    <td>{{ $item->godown2s->godownUnits->unit_name }}</td>
                                    <td>{{ $item->add_qty }}</td>
                                    <td>{{ $item->leave_qty }}</td>
                                    <td>
                                        @php
                                            $total = $total + $item->add_qty - $item->leave_qty;
                                            $add_sum = $add_sum + $item->add_qty;
                                            $leave_sum = $leave_sum + + $item->leave_qty;
                                        @endphp
                                        {{ $total }}
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="5" class="text-right">Total</td>
                                <td>{{ $add_sum }}</td>
                                <td>{{ $leave_sum }}</td>
                                <td>{{ $total }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <br>
                </div>
            </div>
            <a href="{{ route('godown2.ledger-print', $id) }}" class="btn btn-sm btn-primary btn-block">Print</a>
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
    </script>

@endsection

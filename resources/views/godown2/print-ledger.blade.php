@extends('layouts.app')
@section('title')
    Supplier Details
@endsection
@section('header-script')
    <style>
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
            height: 150px;
        }

        #company {
            float: right;
            text-align: right;
        }

        #details {
            margin-bottom: 50px;
        }
    </style>
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="main-page">
            <div class="panel">
                <div class="form-title bg-light ">
                    <h4><strong>Item Details </strong></h4>
                </div>
                <div class="panel-body">
                    <div id="printcontent" style="padding: 5px; overflow: hidden;">
                        <header class="clearfix">
                            <div id="logo">
                                <img src="{{ asset($company->logo) }}">
                            </div>
                            <div id="company">
                                <h3 class="name"><b>{{ $company->name }}</b> </h3>
                                <div ><font size="3">Didar Nibash . 83 / 2 Muradpur High School Road . <br>Jurain . Kadomtoli . Dhaka - 1204 . E - BIN :001437901-0308</font></div>
                                <div><font size="3">{{ $company->mobile}}</font></div>
                                <div><a href="#"><font size="3">{{$company->email }}</font></a></div>
                            </div>
                        </header>
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
                    </div>
                </div>
                <button type="button" class="btn btn-primary print_btn btn-block btn-sm" onclick="printDiv('printcontent');"><i class="fa fa-print"></i> Print</button>
            </div>
        </div>
    </div>
@endsection

@section('footer-script')
    <script>
        function printDiv(divName) {
            $('.print_btn').css('display', 'none');
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
            $('.print_btn').css('display', 'block');
            window.location.href = "{{ url()->current() }}";
        }
    </script>
@endsection

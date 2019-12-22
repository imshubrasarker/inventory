@extends('layouts.app')
@section('title')
   Print Suppliers
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
            @include('layouts.include.alert')
            <div class="forms">
                <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                    <div class="form-title">
                        <h4>Manage Suppliers</h4>
                    </div>
                    <div class="form-body">
                        <div class="card">
                            <div class="card-body">
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
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Mobile</th>
                                                <th scope="col">Balance</th>
                                                <th scope="col">Address</th>
                                                <th scope="col">Note</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($suppliers as $supplier)
                                                <tr>
                                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                                    <td>{{ $supplier->name }}</td>
                                                    <td>{{ $supplier->mobile }}</td>
                                                    <td>{{ $supplier->balance }}</td>
                                                    <td width="15%">{{ $supplier->address }}</td>
                                                    <td width="15%">{{ $supplier->note }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="owners_sign text-center" style="margin-top: 80px; margin-bottom: 30px; float: right">
                                            <hr style="border: 1px solid black;"/>
                                            <h4>Oweners Signature</h4>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-primary print_btn btn-block btn-sm" onclick="printDiv('printcontent');"><i class="fa fa-print"></i> Print</button>
                                        </div>
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

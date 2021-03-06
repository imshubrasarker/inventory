@extends('layouts.app')
@section('title')
    Create New Invoice
@endsection
@section('header-script')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
          rel="stylesheet">
    <style type="text/css">
        .add-product-btn {
            margin-right: 7%;
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
                        <h4>Create New Invoice</h4>
                    </div>
                    <div class="form-body">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ url('/invoices') }}" title="Back">
                                    <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"
                                                                              aria-hidden="true"></i> Back
                                    </button>
                                </a>

                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#customerAdd"><i
                                        class="fa fa-plus" aria-hidden="true"></i> Add Customer
                                </button>

                                <!-- The Modal -->
                                <div class="modal fade" id="customerAdd">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Modal Heading</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;
                                                </button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                {!! Form::open(['url' => '/customers', 'files' => true]) !!}

                                                @include ('customers.form', ['formMode' => 'create'])

                                                {!! Form::close() !!}
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <br/>
                                @if ($errors->any())
                                    <ul class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                {!! Form::open(['url' => '/invoices', 'files' => true]) !!}

                                @include ('invoices.form', ['formMode' => 'create'])

                                {!! Form::close() !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script type="text/javascript">
        // $('.date').datepicker({format: "dd.mm.yyyy"});
        $('.product_id').select2();


        // $(".product_id").change(function(){
        $(document).on('change', '.product_id', function () {

            var product_id = $(this).val();

            var serial = $(this).attr('serial');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('get_product_detail') }}",
                data: {
                    product_id: product_id
                },
                success: function (results) {
                    console.log("Result ", results.product);
                    $("#sale_price_" + serial).val(results.product.final_price);
                    $("#available_quantity_" + serial).val(results.stocks.product_stock);
                }
            });
        });

        var sum = 0;
        $(document).on('keyup', ".quantity", function () {
            var serial = $(this).attr('serial');
            var sale_price = $('#sale_price_' + serial).val();
            var available_quantity = Number($('#available_quantity_' + serial).val());
            var quantity = Number($(this).val());
            var total_amount = sale_price * quantity;

            $("#total_price_" + serial).val(Math.round(total_amount));
            if (quantity > available_quantity) {
                alert('Not Available in Stock.');
                $("#quantity_" + serial).val(0);
                $("#total_price_" + serial).val(0);
            }
            total_cal();
            cal_tital_qty();
        });

        function total_cal() {
            sum = 0;
            $(".product_total_price").each(function () {
                sum += Number($(this).val());
            });
            $('.grand_total_price').val(Math.round(parseFloat(sum) ));
            cal_due_amount();
        }

        function total_cal_for_grand() {
            sum = 0;
            $(".product_total_price").each(function () {
                sum += Number($(this).val());
            });
            $('.grand_total_price').val(Math.round(parseFloat(sum) ));
        }

        $('#discount').on('focusout', function () {
            cal_due_amount()
        })

        var rowCount = 1;

        function addMoreRows(frm) {

            var cures = <?php echo json_encode($products) ?>;
            rowCount++;
            var html = '<div class="row" id="registration' + rowCount + '"><div class="col-md-3"><div class="form-group "><label for="product_id[]" class="control-label">Product</label><select class="form-control product_id product_id_' + rowCount + '" serial="' + rowCount + '" id="product_id[]" name="product_id[]"><option value="">Select Product</option><?php foreach($products as $key=>$value){ ?><option value="<?php echo $key; ?>"><?php echo stripslashes($value); ?></option> <?php } ?></select></div></div><div class="col-md-2"><div class="form-group "><label for="sale_price[]" class="control-label">Sale Price</label><input class="form-control" readonly="readonly" id="sale_price_' + rowCount + '" name="sale_price[]" type="text"></div></div><div class="col-md-2"><div class="form-group "><label for="available_quantity[]" class="control-label">Available Quantity</label><input class="form-control" readonly="readonly" id="available_quantity_' + rowCount + '" name="available_quantity[]" type="text"></div></div><div class="col-md-2"><div class="form-group "><label for="quantity[]" class="control-label">Quantity</label><input class="form-control quantity" serial="' + rowCount + '" name="quantity[]" type="text" id="quantity_' + rowCount + '"></div></div><div class="col-md-2"><div class="form-group "><label for="total_price[]" class="control-label">Total Price</label><input class="form-control product_total_price" readonly name="total_price[]" type="text" id="total_price_' + rowCount + '"></div></div><div class="col-md-1"> <br><button type="button"  class="removeButton" serial="' + rowCount + '" style="float:left;" title="' + rowCount + '"> <i class="fa fa-trash btn btn-danger"></i></button></div></div>';

            $('#addedRows').append(html);
            $(".product_id_" + rowCount).select2();
        }

        $(document).on('change', '.customer', function () {

            var customer_id = $(this).val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('get_customer_detail') }}",
                data: {
                    customer_id: customer_id,
                },
                success: function (results) {
                    $(".mobile_no").val(results.customer.primary_mobile);
                    $(".address").val(results.customer.address);
                    $(".due_amount_customer").val(results.due_amount);
                }
            });

        });

        $(document).on('keyup', '#advanced', function () {
            cal_due_amount();
        });

        $(document).on('focusout', '#transport', function () {
            cal_due_amount()
        });

        function cal_due_amount() {
            var due = 0;
            total_cal_for_grand();
            var grand_price = $('.grand_total_price').val() ? $('.grand_total_price').val() : 0;
            var advanced = $("#advanced").val() ? $("#advanced").val() : 0;
            let discount = $('#discount').val() ? $('#discount').val() : 0;
            var transport = $(".transport").val() ? $(".transport").val() : 0;
            due = grand_price - advanced - discount + parseFloat(transport);
            $("#due_amount").val(Math.round(due));
            $('.grand_total_price').val(parseFloat(grand_price) + parseFloat(transport))
        }

        function cal_tital_qty() {
            qsum = 0;
            $(".quantity").each(function () {
                qsum += Number($(this).val());
            });
            $('#total_qty').val(Math.round(qsum));
        }

        function cal_transport() {
            var transport = 0;
            var due_amount = $("#due_amount").val() ? $("#due_amount").val() : 0;

            var grand_price = $('#grand_total_price').val() ? $('#grand_total_price').val() : 0;
            transport = $(".transport").val() ? $(".transport").val() : 0;

            var due = parseFloat(grand_price) + parseFloat(transport);

            $('#grand_total_price').val(Math.round(due));

            $("#due_amount").val(Math.round(parseFloat(due_amount) + parseFloat(transport)));
        }

        $(document).on('click', '.removeButton', function () {
            var deleteRowSerial = $(this).attr('serial');
            $("#registration" + deleteRowSerial).remove();
            total_cal();
        });

        $('#customer_id').select2();

    </script>
@endsection

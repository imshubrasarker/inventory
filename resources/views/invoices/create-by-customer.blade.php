@extends('layouts.app')
@section('title')
Create New Invoice
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
                    <h4>Create New Invoice</h4>
                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ url('/invoices') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                            <br />
                            <br />
                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            {!! Form::open(['url' => '/invoices', 'files' => true, 'name'=>'invoice-create']) !!}

                            @php
                                $record = App\Invoice::latest()->count();
                                if($record == 0){
                                    $record = 0;
                                }
                                //increase 1 with last invoice number
                                $nextInvoiceNumber = $record+1;
                            @endphp
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('invoice_no') ? 'has-error' : ''}}">
                                        {!! Form::label('invoice_no', 'Invoice No', ['class' => 'control-label']) !!}
                                        {!! Form::text('invoice_no',str_pad($nextInvoiceNumber,6,"0",STR_PAD_LEFT), ('' == 'required') ? ['class' => 'form-control', 'required' => 'required','readonly'=>'readonly'] : ['class' => 'form-control','readonly'=>'readonly']) !!}
                                        {!! $errors->first('invoice_no', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('manual_date') ? 'has-error' : ''}}">
                                        {!! Form::label('manual_date', 'Date', ['class' => 'control-label']) !!}
                                        {!! Form::date('manual_date',(Carbon\Carbon::now()->format('Y-m-d')), ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                        {!! $errors->first('manual_date', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('customer_id') ? 'has-error' : ''}}">
                                        {!! Form::label('customer_id', 'Customer', ['class' => 'control-label']) !!}
                                        {!! Form::select('customer_id', $customers, null, ('' == 'required') ? ['class' => 'form-control customer', 'required' => 'required','placeholder'=>'Select Customer', 'id'=>'customer_id'] : ['class' => 'form-control customer','placeholder'=>'Select Customer', 'id'=>'customer_id']) !!}
                                        {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('mobile_no') ? 'has-error' : ''}}">
                                        {!! Form::label('mobile_no', 'Mobile No', ['class' => 'control-label']) !!}
                                        {!! Form::text('mobile_no', null, ('' == 'required') ? ['class' => 'form-control mobile_no', 'required' => 'required', 'readonly'=>'readonly'] : ['class' => 'form-control mobile_no', 'readonly'=>'readonly']) !!}
                                        {!! $errors->first('mobile_no', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                                        {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
                                        {!! Form::textarea('address', null, ('' == 'required') ? ['class' => 'form-control address', 'required' => 'required','rows'=>'2','cols'=>'5', 'readonly'=>'readonly'] : ['class' => 'form-control address','rows'=>'2','cols'=>'5', 'readonly'=>'readonly']) !!}
                                        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('notebar') ? 'has-error' : ''}}">
                                        {!! Form::label('notebar', 'Note', ['class' => 'control-label']) !!}
                                        {!! Form::textarea('notebar', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required','rows'=>'2','cols'=>'5'] : ['class' => 'form-control','rows'=>'2','cols'=>'5']) !!}
                                        {!! $errors->first('notebar', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>



                            <div class="row" id="registration1">

                                <div class="col-md-2">
                                    <div class="form-group {{ $errors->has('product_id[]') ? 'has-error' : ''}}">
                                        {!! Form::label('product_id[]', 'Product', ['class' => 'control-label']) !!}
                                        {!! Form::select('product_id[]', $products, null, ('' == 'required') ? ['class' => 'form-control product_id', 'required' => 'required','serial'=>'1', 'placeholder'=>'Select Product'] : ['class' => 'form-control product_id', 'serial'=>'1', 'placeholder'=>'Select Product']) !!}
                                        {!! $errors->first('product_id[]', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group {{ $errors->has('sale_price[]') ? 'has-error' : ''}}">
                                        {!! Form::label('sale_price[]', 'Sale Price', ['class' => 'control-label']) !!}
                                        {!! Form::text('sale_price[]', null, ('' == 'required') ? ['class' => 'form-control', 'id'=>'sale_price_1','required' => 'required','readonly'=>'readonly'] : ['class' => 'form-control','readonly'=>'readonly','id'=>'sale_price_1',]) !!}
                                        {!! $errors->first('sale_price[]', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group {{ $errors->has('available_quantity[]') ? 'has-error' : ''}}">
                                        {!! Form::label('available_quantity[]', 'Available Quantity', ['class' => 'control-label']) !!}
                                        {!! Form::text('available_quantity[]', null, ('' == 'required') ? ['class' => 'form-control', 'id'=>'available_quantity_1','required' => 'required','readonly'=>'readonly'] : ['class' => 'form-control','readonly'=>'readonly','id'=>'available_quantity_1',]) !!}
                                        {!! $errors->first('available_quantity[]', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group {{ $errors->has('quantity[]') ? 'has-error' : ''}}">
                                        {!! Form::label('quantity[]', 'Quantity', ['class' => 'control-label']) !!}
                                        {!! Form::text('quantity[]', null, ('' == 'required') ? ['class' => 'form-control quantity', 'serial'=>'1', 'required' => 'required', 'id' => 'quantity_1'] : ['class' => 'form-control quantity', 'serial'=>'1', 'id' => 'quantity_1']) !!}
                                        {!! $errors->first('quantity[]', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group {{ $errors->has('total_price[]') ? 'has-error' : ''}}">
                                        {!! Form::label('total_price[]', 'Total Price', ['class' => 'control-label']) !!}
                                        {!! Form::text('total_price[]', null, ('' == 'required') ? ['class' => 'form-control product_total_price', 'required' => 'required', 'id'=>'total_price_1', 'readonly'=>'readonly'] : ['class' => 'form-control product_total_price', 'id'=>'total_price_1', 'readonly'=>'readonly']) !!}
                                        {!! $errors->first('total_price[]', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                <div class="col-md-2"> <br>
                                    <button type="button" class="removeButton" serial="1" style="float:left;"> <i  class="fa fa-trash btn btn-danger"></i></button>    
                                </div>

                            </div>

                            <div id="addedRows"></div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn pull-right add-product-btn" onclick="addMoreRows(this.form);" type="button">
                                            <i  class="fa fa-plus btn btn-success"></i>
                                        </button>    
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('grand_total_price') ? 'has-error' : ''}}">
                                        {!! Form::label('grand_total_price', 'Grand Total Price', ['class' => 'control-label']) !!}
                                        {!! Form::text('grand_total_price', null, ('' == 'required') ? ['class' => 'form-control grand_total_price', 'required' => 'required', 'readonly'=>'readonly'] : ['class' => 'form-control grand_total_price', 'readonly'=>'readonly']) !!}
                                        {!! $errors->first('grand_total_price', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('advanced') ? 'has-error' : ''}}">
                                        {!! Form::label('advanced', 'Advanced Amount', ['class' => 'control-label']) !!}
                                        {!! Form::text('advanced', null, ('' == 'required') ? ['class' => 'form-control', 'id'=>'advanced', 'required' => 'required'] : ['class' => 'form-control', 'id'=>'advanced',]) !!}
                                        {!! $errors->first('advanced', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('due_amount') ? 'has-error' : ''}}">
                                        {!! Form::label('due_amount', 'Due Amount', ['class' => 'control-label']) !!}
                                        {!! Form::text('due_amount', null, ('' == 'required') ? ['class' => 'form-control', 'id'=>'due_amount', 'required' => 'required', 'readonly'=>'readonly'] : ['class' => 'form-control', 'readonly'=>'readonly', 'id'=>'due_amount']) !!}
                                        {!! $errors->first('due_amount', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>




                            <div class="form-group">
                                {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
                            </div>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>



<script type="text/javascript">
  document.forms['invoice-create'].elements['customer_id'].value="{{ $id }}";
    // $(document).ready(function() {
    //     $('.product_id').select2();
    // });
    
    // $(".product_id").change(function(){
    $(document).on('change','.product_id',function(){

      var product_id = $(this).val();
      
      var serial = $(this).attr('serial');
        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
             type:"POST",
             url:"{{ route('get_product_detail') }}",
             data: {
                product_id : product_id
             },
             success : function(results) {
                $("#sale_price_"+serial).val(results.product.final_price);
                $("#available_quantity_"+serial).val(results.stocks.product_stock);
             }
        });
   });
  var sum = 0;
    $(document).on('keyup', ".quantity", function(){
      var serial = $(this).attr('serial');
      var sale_price =  $('#sale_price_'+serial).val();
      var available_quantity =  $('#available_quantity_'+serial).val();
      var quantity = parseInt($(this).val());
      var total_amount = sale_price*quantity;
      $("#total_price_"+serial).val(total_amount);
      if(quantity > available_quantity){
        alert('Not Available in Stock.');
        $("#quantity_"+serial).val(0);
        $("#total_price_"+serial).val(0);
      }
      total_cal();
    });


   function total_cal(){
    sum = 0;
      $(".product_total_price").each(function() {
            sum += Number($(this).val());
        });
      $('.grand_total_price').val(sum);
      cal_due_amount();
   }

    var rowCount = 1;
    function addMoreRows(frm) {
        var cures = <?php echo json_encode( $products) ?>;
        rowCount ++;
        var html = '<div class="row" id="registration'+rowCount+'"><div class="col-md-2"><div class="form-group "><label for="product_id[]" class="control-label">Product</label><select class="form-control product_id" serial="'+rowCount+'" id="product_id[]" name="product_id[]"><option value="">Select Product</option><?php foreach($products as $key=>$value){ ?><option value="<?php echo $key; ?>"><?php echo $value; ?></option> <?php } ?></select></div></div><div class="col-md-2"><div class="form-group "><label for="sale_price[]" class="control-label">Sale Price</label><input class="form-control" readonly="readonly" id="sale_price_'+rowCount+'" name="sale_price[]" type="text"></div></div><div class="col-md-2"><div class="form-group "><label for="available_quantity[]" class="control-label">Available Quantity</label><input class="form-control" readonly="readonly" id="available_quantity_'+rowCount+'" name="available_quantity[]" type="text"></div></div><div class="col-md-2"><div class="form-group "><label for="quantity[]" class="control-label">Quantity</label><input class="form-control quantity" serial="'+rowCount+'" name="quantity[]" type="text" id="quantity_'+rowCount+'"></div></div><div class="col-md-2"><div class="form-group "><label for="total_price[]" class="control-label">Total Price</label><input class="form-control product_total_price" readonly name="total_price[]" type="text" id="total_price_'+rowCount+'"></div></div><div class="col-md-2"> <br><button type="button"  class="removeButton" serial="'+rowCount+'" style="float:left;" title="'+rowCount+'"> <i class="fa fa-trash btn btn-danger"></i></button></div></div>';
        
        $('#addedRows').append(html);
    }

    $(document).on('change','.customer',function(){

      var customer_id = $(this).val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            url:"{{ route('get_customer_detail') }}",
            data: {
                customer_id : customer_id,
            },
            success : function(results) {
                $(".mobile_no").val(results.customer.primary_mobile);
                $(".address").val(results.customer.address);
            }  
        });
            
    });

     $(document).on('keyup', '#advanced', function(){
        cal_due_amount();
   });
     function cal_due_amount()
     {
        var grand_price = $('#grand_total_price').val();
        var advanced = $("#advanced").val();
        var due = grand_price-advanced;
        $("#due_amount").val(due);
     }

     $(document).on('click','.removeButton',function(){
        var deleteRowSerial = $(this).attr('serial');
        $("#registration"+deleteRowSerial).remove();
        total_cal();
     });

    var customer_id = $("#customer_id").val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:"POST",
        url:"{{ route('get_customer_detail') }}",
        data: {
            customer_id : customer_id,
        },
        success : function(results) {
            $(".mobile_no").val(results.customer.primary_mobile);
            $(".address").val(results.customer.address);
        }  
    });

</script>
@endsection
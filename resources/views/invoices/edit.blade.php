@extends('layouts.app')
@section('title')
Edit Invoice #{{ $invoice->id }}
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
                    <h4>Edit Invoice #{{ $invoice->id }}</h4>
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

                            {!! Form::model($invoice, [
                                'method' => 'PATCH',
                                'url' => ['/invoices', $invoice->id],
                                'files' => true
                            ]) !!}

                            @include ('invoices.form', ['formMode' => 'edit'])

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
<script type="text/javascript">
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
                $("#sale_price_"+serial).val(results.product.sale_price);
             }
        });
   });
    var sum = 0;
   $(document).on('keyup', '.quantity', function(){
        var serial = $(this).attr('serial');
       var sale_price =  $('#sale_price_'+serial).val();
       var quantity = $(this).val();
       var total_amount = sale_price*quantity;
       $("#total_price_"+serial).val(total_amount);
       
        $(".product_total_price").each(function() {
            sum += Number($(this).val());
        });
        $('.grand_total_price').val(sum);
   });

    var rowCount = 1;
    function addMoreRows(frm) {
        var cures = <?php echo json_encode( $products) ?>;
        rowCount ++;
        var html = '<div class="row" id="registration'+rowCount+'"><div class="col-md-3"><div class="form-group "><label for="product_id[]" class="control-label">Product</label><select class="form-control product_id" serial="'+rowCount+'" id="product_id[]" name="product_id[]"><option value="">Select Product</option><?php foreach($products as $key=>$value){ ?><option value="<?php echo $key; ?>"><?php echo $value; ?></option> <?php } ?></select></div></div><div class="col-md-3"><div class="form-group "><label for="sale_price[]" class="control-label">Sale Price</label><input class="form-control" readonly="readonly" id="sale_price_'+rowCount+'" name="sale_price[]" type="text"></div></div><div class="col-md-2"><div class="form-group "><label for="quantity[]" class="control-label">Quantity</label><input class="form-control quantity" serial="'+rowCount+'" name="quantity[]" type="text" id="quantity[]"></div></div><div class="col-md-2"><div class="form-group "><label for="total_price[]" class="control-label">Total Price</label><input class="form-control product_total_price" name="total_price[]" type="text" id="total_price_'+rowCount+'"></div></div><div class="col-md-2"> <br><button type="button"  id="removeButton" style="float:left;" title="'+rowCount+'"> <i class="fa fa-trash btn btn-danger"></i></button></div></div>';
        
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
        var grand_price = $('#grand_total_price').val();
        var advanced = $(this).val();
        var due = grand_price-advanced;
        $("#due_amount").val(due);
   });

     var counter = 2;
     $("#removeButton").click(function () {
    if(counter==1){
          alert("No more textbox to remove");
          return false;
       }   

        counter--;


        $("#registration"+counter).remove();
        
     });

</script>
@endsection
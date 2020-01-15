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
            {!! Form::text('invoice_no',str_pad($record,6,"0",STR_PAD_LEFT), ('' == 'required') ? ['class' => 'form-control', 'required' => 'required','readonly'=>'readonly'] : ['class' => 'form-control','readonly'=>'readonly']) !!}
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
        <div class="form-group {{ $errors->has('due_amount') ? 'has-error' : ''}}">
            <label for="due_amount" class="form-label">Due Amount</label>
            <input type="text" name="due_amount" class="form-control due_amount_customer" readonly>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('transport') ? 'has-error' : ''}}">
            <label for="transport" class="form-label">Transport</label>
            <input type="text" name="transport" class="form-control transport">
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

    <div class="col-md-3">
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

    <div class="col-md-1"> <br>
        <button type="button" class="removeButton" serial="1" style="float:left;"> <i  class="fa fa-trash btn btn-danger"></i></button>
    </div>

</div>

<div id="addedRows"></div>

<div class="row">
    <div class="col-md-13">
        <div class="form-group">
            <button class="btn pull-right add-product-btn" onclick="addMoreRows(this.form);" type="button">
                <i  class="fa fa-plus btn btn-success"></i>
            </button>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('total_qty') ? 'has-error' : ''}}">
            {!! Form::label('total_qty', 'Total Quantity', ['class' => 'control-label']) !!}
            {!! Form::text('total_qty', null, ('' == 'required') ? ['class' => 'form-control', 'id'=>'total_qty', 'required' => 'required', 'readonly'=>'readonly'] : ['class' => 'form-control', 'readonly'=>'readonly', 'id'=>'total_qty']) !!}
            {!! $errors->first('total_qty', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-3">
        <label for="" class="control-label">Discount</label>
        <input type="text" class="form-control" name="discount" id="discount" value="0">
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('advanced') ? 'has-error' : ''}}">
            {!! Form::label('advanced', 'Advanced Amount', ['class' => 'control-label']) !!}
            {!! Form::text('advanced', null, ('' == 'required') ? ['class' => 'form-control', 'id'=>'advanced', 'required' => 'required'] : ['class' => 'form-control', 'id'=>'advanced',]) !!}
            {!! $errors->first('advanced', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group {{ $errors->has('due_amount') ? 'has-error' : ''}}">
            {!! Form::label('due_amount', 'Due Amount', ['class' => 'control-label']) !!}
            {!! Form::text('due_amount', null, ('' == 'required') ? ['class' => 'form-control', 'id'=>'due_amount', 'required' => 'required', 'readonly'=>'readonly'] : ['class' => 'form-control', 'readonly'=>'readonly', 'id'=>'due_amount']) !!}
            {!! $errors->first('due_amount', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('grand_total_price') ? 'has-error' : ''}}">
            {!! Form::label('grand_total_price', 'Grand Total Price', ['class' => 'control-label']) !!}
            {!! Form::text('grand_total_price', null, ('' == 'required') ? ['class' => 'form-control grand_total_price', 'required' => 'required', 'readonly'=>'readonly'] : ['class' => 'form-control grand_total_price', 'readonly'=>'readonly']) !!}
            {!! $errors->first('grand_total_price', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

</div>
<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>

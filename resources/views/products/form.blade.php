<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            {!! Form::label('name', 'Product Name', ['class' => 'control-label']) !!}
            {!! Form::text('name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('size') ? 'has-error' : ''}}">
            {!! Form::label('size', 'Size', ['class' => 'control-label']) !!}
            {!! Form::text('size', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('size', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('buy_price') ? 'has-error' : ''}}">
            {!! Form::label('buy_price', 'Buy Price', ['class' => 'control-label']) !!}
            {!! Form::text('buy_price', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('buy_price', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('sale_price') ? 'has-error' : ''}}">
            {!! Form::label('sale_price', 'Sale Price', ['class' => 'control-label']) !!}
            {!! Form::text('sale_price', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('sale_price', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('unit_id') ? 'has-error' : ''}}">
            {!! Form::label('unit_id', 'Unit', ['class' => 'control-label']) !!}
            {!! Form::select('unit_id', $units, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('unit_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
            {!! Form::label('category_id', 'Category', ['class' => 'control-label']) !!}
            {!! Form::select('category_id', $categories, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('discount') ? 'has-error' : ''}}">
            {!! Form::label('discount', 'Discount', ['class' => 'control-label']) !!}
            {!! Form::text('discount', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('discount', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
            {!! Form::label('description', 'Note', ['class' => 'control-label']) !!}
            {!! Form::textarea('description', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'rows'=>'2','cols'=>'5'] : ['class' => 'form-control', 'rows'=>'2','cols'=>'5']) !!}
            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>



<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="form-group {{ $errors->has('alert_quantity') ? 'has-error' : ''}}">
            {!! Form::label('alert_quantity', 'Alert Quantity', ['class' => 'control-label']) !!}
            {!! Form::number('alert_quantity', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('alert_quantity', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="form-group">
            {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary btn-block']) !!}
        </div>
    </div>
</div>

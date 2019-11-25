<div class="row">
	<div class="col-md-6">
		<div class="form-group {{ $errors->has('product') ? 'has-error' : ''}}">
		    {!! Form::label('product_id', 'Product', ['class' => 'control-label']) !!}
		    {!! Form::select('product_id',$products, null, ('' == 'required') ? ['class' => 'form-control', 'id'=>'product_list', 'required' => 'required','placeholder'=>'---Select Product---'] : ['class' => 'form-control','id'=>'product_list', 'placeholder'=>'---Select Product---']) !!}
		    {!! $errors->first('product_id', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group {{ $errors->has('product_stock') ? 'has-error' : ''}}">
		    {!! Form::label('product_stock', 'Add Stock', ['class' => 'control-label']) !!}
		    {!! Form::text('product_stock', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
		    {!! $errors->first('product_stock', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group {{ $errors->has('avialable_stock') ? 'has-error' : ''}}">
		    {!! Form::label('avialable_stock', 'Avialable Stock', ['class' => 'control-label']) !!}
		    {!! Form::text('avialable_stock', null, ('' == 'required') ? ['class' => 'form-control', 'id'=>'avialable_stock', 'required' => 'required', 'readonly'=>'readonly'] : ['class' => 'form-control','id'=>'avialable_stock', 'readonly'=>'readonly']) !!}
		    {!! $errors->first('avialable_stock', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group {{ $errors->has('sale_price') ? 'has-error' : ''}}">
		    {!! Form::label('sale_price', 'Sale Price', ['class' => 'control-label']) !!}
		    {!! Form::text('sale_price', null, ('' == 'required') ? ['class' => 'form-control', 'id'=>'sale_price', 'required' => 'required', 'readonly'=>'readonly'] : ['class' => 'form-control','id'=>'sale_price', 'readonly'=>'readonly']) !!}
		    {!! $errors->first('sale_price', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group {{ $errors->has('size') ? 'has-error' : ''}}">
		    {!! Form::label('size', 'Size', ['class' => 'control-label']) !!}
		    {!! Form::text('size', null, ('' == 'required') ? ['class' => 'form-control', 'id'=>'size', 'required' => 'required', 'readonly'=>'readonly'] : ['class' => 'form-control','id'=>'size', 'readonly'=>'readonly']) !!}
		    {!! $errors->first('size', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group {{ $errors->has('note') ? 'has-error' : ''}}">
		    {!! Form::label('note', 'Note', ['class' => 'control-label']) !!}
		    {!! Form::textarea('note', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'rows' => '2', 'cols' => '5'] : ['class' => 'form-control', 'rows' => '2', 'cols' => '5']) !!}
		    {!! $errors->first('note', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="form-group">
		    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
		</div>
	</div>
</div>

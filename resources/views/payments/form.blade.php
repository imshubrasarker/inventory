@if($formMode == 'create')
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('customer_id') ? 'has-error' : ''}}">
            {!! Form::label('customer_id', 'Customer', ['class' => 'control-label']) !!}
            {!! Form::select('customer_id', $customers, null, ('' == 'required') ? ['class' => 'form-control customer', 'required' => 'required','placeholder'=>'Select Customer'] : ['class' => 'form-control customer','placeholder'=>'Select Customer']) !!}
            {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('manual_date') ? 'has-error' : ''}}">
            {!! Form::label('manual_date', 'Date', ['class' => 'control-label']) !!}
            {!! Form::date('manual_date', (Carbon\Carbon::now()->format('Y-m-d')), ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('manual_date', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('mobile_no') ? 'has-error' : ''}}">
            {!! Form::label('mobile_no', 'Mobile No', ['class' => 'control-label']) !!}
            {!! Form::number('mobile_no', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required','id'=>'customer_mobile','readonly'=>'readonly'] : ['class' => 'form-control','id'=>'customer_mobile','readonly'=>'readonly']) !!}
            {!! $errors->first('mobile_no', '<p class="help-block">:message</p>') !!}
        </div>
    </div>



@endif
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
            {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
            {!! Form::textarea('address', null, ('' == 'required') ? ['class' => 'form-control address', 'required' => 'required','rows'=>'2','cols'=>'5', 'readonly'=>'readonly'] : ['class' => 'form-control address','rows'=>'2','cols'=>'5', 'readonly'=>'readonly']) !!}
            {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
        </div>

    </div>
</div>
@if($formMode == 'create')
<div class="row">
    <div class="col-md-6">
        <label for="" class="control-label">Due Amount</label>
        <input type="text" name="due_amount" id="due_amount" class="form-control" readonly>
    </div>
    <div class="col-md-6">

        <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
            {!! Form::label('amount', 'Amount', ['class' => 'control-label']) !!}
            {!! Form::number('amount', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('notebar') ? 'has-error' : ''}}">
            {!! Form::label('notebar', 'Note', ['class' => 'control-label']) !!}
            {!! Form::textarea('notebar', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required','rows'=>'2','cols'=>'10'] : ['class' => 'form-control','rows'=>'2','cols'=>'10']) !!}
            {!! $errors->first('notebar', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

@endif

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="form-group">
            {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary btn-block']) !!}
        </div>
    </div>
</div>

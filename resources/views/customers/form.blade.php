<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
            {!! Form::text('name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
            {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
            {!! Form::email('email', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('primary_mobile') ? 'has-error' : ''}}">
            {!! Form::label('primary_mobile', 'Primary Mobile Number', ['class' => 'control-label']) !!}
            {!! Form::text('primary_mobile', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('primary_mobile', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('alter_mobile') ? 'has-error' : ''}}">
            {!! Form::label('alter_mobile', 'Alternative Mobile Number', ['class' => 'control-label']) !!}
            {!! Form::text('alter_mobile', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('alter_mobile', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
            {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
            {!! Form::textarea('address', null, ('' == 'required') ? ['class' => 'form-control', 'rows'=>'2', 'cols' => '3', 'required' => 'required'] : ['class' => 'form-control', 'rows'=>'2', 'cols' => '3']) !!}
            {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('note') ? 'has-error' : ''}}">
            {!! Form::label('note', 'Note', ['class' => 'control-label']) !!}
            {!! Form::textarea('note', null, ('' == 'required') ? ['class' => 'form-control', 'rows'=>'2', 'cols' => '3', 'required' => 'required'] : ['class' => 'form-control', 'rows'=>'2', 'cols' => '3']) !!}
            {!! $errors->first('note', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('quantity') ? 'has-error' : ''}}">
            {!! Form::label('quantity', 'Opening Quantity', ['class' => 'control-label']) !!}
            {!! Form::text('quantity', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('quantity', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('due') ? 'has-error' : ''}}">
            {!! Form::label('due', 'Opening Balance', ['class' => 'control-label']) !!}
            {!! Form::text('due', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('due', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
            {!! Form::label('image', 'Image', ['class' => 'control-label']) !!}
            {!! Form::file('image', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
        </div>
        @if($formMode == 'edit')
            <div class="form-group">
                <img src="{{ asset($customer->image) }}" alt="" style="width: 200px; height: 200px;">
            </div>
        @endif
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary btn-block']) !!}
        </div>
    </div>
</div>

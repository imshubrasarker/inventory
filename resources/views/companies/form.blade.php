<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
            {!! Form::text('name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
            {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
            {!! Form::textarea('address', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required','rows'=>'2'] : ['class' => 'form-control','rows'=>'2']) !!}
            {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('mobile') ? 'has-error' : ''}}">
            {!! Form::label('mobile', 'Mobile', ['class' => 'control-label']) !!}
            {!! Form::text('mobile', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('mobile', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
            {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
            {!! Form::text('email', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>




<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('quote') ? 'has-error' : ''}}">
            {!! Form::label('quote', 'Quote', ['class' => 'control-label']) !!}
            {!! Form::textarea('quote', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'rows' => '3', 'cols' => '5'] : ['class' => 'form-control', 'rows' => '3', 'cols' => '5']) !!}
            {!! $errors->first('quote', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('logo') ? 'has-error' : ''}}">
            {!! Form::label('logo', 'Logo', ['class' => 'control-label']) !!}
            {!! Form::file('logo', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('logo', '<p class="help-block">:message</p>') !!}
        </div>
        @if($formMode == 'edit')
            <div class="form-group">
                <img src="{{ asset($company->logo) }}" alt="" style="width: 120px; height: 120px; ">
            </div>
        @endif
    </div>
</div>



<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
</div>

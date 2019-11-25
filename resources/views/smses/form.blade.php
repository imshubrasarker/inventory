<div class="row">
	<div class="col-md-6">
		<div class="form-group {{ $errors->has('username') ? 'has-error' : ''}}">
		    {!! Form::label('username', 'Username', ['class' => 'control-label']) !!}
		    {!! Form::text('username', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
		    {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
		    {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
		    {!! Form::text('password', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
		    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
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


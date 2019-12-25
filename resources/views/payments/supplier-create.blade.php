@extends('layouts.app')
@section('title')
    Create New Payment
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
                        <h4>Receive Payment</h4>
                    </div>
                    <div class="form-body">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ url('/payments') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                                <br />
                                <br />
                                @if ($errors->any())
                                    <ul class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                {!! Form::open(['url' => '/payments', 'files' => true]) !!}

{{--                                @if($formMode == 'create')--}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('supplier_id') ? 'has-error' : ''}}">
                                                {!! Form::label('supplier_id', 'Supplier', ['class' => 'control-label']) !!}
                                                {!! Form::select('supplier_id', $suppliers, null, ('' == 'required') ? ['class' => 'form-control supplier', 'required' => 'required','placeholder'=>'Select Supplier'] : ['class' => 'form-control supplier','placeholder'=>'Select Supplier']) !!}
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



{{--                                        @endif--}}
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                                                {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
                                                {!! Form::textarea('address', null, ('' == 'required') ? ['class' => 'form-control address', 'required' => 'required','rows'=>'2','cols'=>'5', 'readonly'=>'readonly'] : ['class' => 'form-control address','rows'=>'2','cols'=>'5', 'readonly'=>'readonly']) !!}
                                                {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                                            </div>

                                        </div>
                                    </div>
{{--                                    @if($formMode == 'create')--}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('payment_method') ? 'has-error' : ''}}">
                                                    {!! Form::label('payment_method', 'Payment Method', ['class' => 'control-label']) !!}
                                                    {!! Form::select('payment_method', (['Advanced'=>'Advanced','Cash'=>'Cash', 'Credit'=>'Credit','Bkash'=>'Bkash','Rocket'=>'Rocket']), null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                    {!! $errors->first('payment_method', '<p class="help-block">:message</p>') !!}
                                                </div>
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

{{--                                    @endif--}}

                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-4">
                                            <div class="form-group">
                                                {!! Form::submit('Create', ['class' => 'btn btn-primary btn-block']) !!}
                                            </div>
                                        </div>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('.customer').select2();
        });

        $(document).on('change','.supplier', function(){
            var customer_id = $(this).val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                url:"{{ route('get_supplier_detail') }}",
                data: {
                    supplier_id : customer_id,
                },
                success : function(results) {
                    console.log('data', results);
                    $("#customer_mobile").val(results.supplier.mobile);
                    $("#address").val(results.supplier.address);
                    console.log('data', results);
                }
            });
        });
    </script>
@endsection

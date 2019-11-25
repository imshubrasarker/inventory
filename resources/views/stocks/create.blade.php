@extends('layouts.app')
@section('title')
Create New Stock
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
                    <h4>Create New Stock</h4>
                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ url('/stocks') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                            <br />
                            <br />
                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            {!! Form::open(['url' => '/stocks', 'files' => true]) !!}

                            @include ('stocks.form', ['formMode' => 'create'])

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
 <script>
      $('#product_list').select2();

      $(document).on('change','#product_list', function(){
            var product_id = $("#product_list").val();
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
                console.log(results.product);
                $("#sale_price").val(results.product.sale_price);
                $("#size").val(results.product.size);
                $("#avialable_stock").val(results.stocks.product_stock);
             }
        });
      });


</script>
@endsection
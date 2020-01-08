@extends('layouts.app')
@section('title')
    Create Production
@endsection
@section('header-script')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="main-page">
            @include('layouts.include.alert')
            <div class="forms">
                <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                    <div class="form-title">
                        <h4>Create Production</h4>
                    </div>
                    <div class="form-body">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ url('/home') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                                <br>
                                <br>
                                @if ($errors->any())
                                    <ul class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                <form action="{{ route('godown2.store') }}" method="post">
                                    @csrf
                                    <div class="row mb-2">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label  mb-2">Select Product <span class="text-danger">*</span></label>
                                                <select class="form-control select2" name="product_id" id="product_id">
                                                    <option value="">Select Product</option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->size }})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Size <span class="text-danger">*</span></label>
                                                <input type="text" placeholder="Size" class="form-control" name="size" id="size" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label  mb-2">Color<span class="text-danger">*</span></label>
                                                <select class="form-control" name="color_id" id="colors">
                                                    <option value="">Select Color</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Quantity<span class="text-danger">*</span></label>
                                                <input type="number" placeholder="Quantity" class="form-control" required name="qty">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Note</label>
                                                <textarea placeholder="Note" class="form-control" name="note"></textarea>
                                            </div>
                                        </div>
                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Date</label>
                                                <input value="{{date("Y-m-d")}}" type="date" class="form-control" name="date" required placeholder="Date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button class="btn btn-primary float-right" type="submit">Create</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>

        $(document).ready(function() {
            $('.select2').select2();
        });

        $(document).on('change','#product_id', function(){
            $("#colors").find('option').not(':first').remove()
            var product_id = $("#product_id").val();
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
                    $("#size").val(results.product.size);
                }
            });
            $.ajax({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                url:"{{ route('get_product_colors') }}",
                data: {
                    product_id : product_id
                },
                success : function(results) {
                    let colors = results.colors;
                    for(var i = 0; i < colors.length; i++)
                    {
                        // console.log(colors[i].id);
                        $('#colors').append('<option value="' + colors[i].id + '">' + colors[i].unit_name+ '</option>');
                    }
                }
            });
        });

    </script>
@endsection

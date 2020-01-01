@extends('layouts.app')
@section('title')
    Create Purchase
@endsection
@section('header-script')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="main-page">
            @include('layouts.include.alert')
            <div class="forms">
                <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                    <div class="form-title">
                        <h4>Create Purchase</h4>
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

                                <form action="{{ route('purchase.store') }}" method="post">
                                    @csrf
                                    <div class="row mb-2">
                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Supplier<span class="text-danger">*</span></label>
                                                <select name="supplier_id" id="supplier" class="form-control supplier">
                                                    <option value="">Select Supplier</option>
                                                    @foreach ($suplliers as $suppler )
                                                        <option value="{{ $suppler->id }}">{{ $suppler->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Date <span class="text-danger">*</span></label>
                                                <input type="date" placeholder="Date" class="form-control" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" name="date" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Address <span class="text-danger">*</span></label>
                                                <textarea name="address" id="address" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Mobile Number <span class="text-danger">*</span></label>
                                                <input type="text" placeholder="Mobile Number" class="form-control" id="mobile" name="mobile" required>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row mb-2">
                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Category<span class="text-danger">*</span></label>
                                                <select name="category_id" id="category" class="form-control category">
                                                    <option value="">Select Category</option>
                                                    @foreach ($categories as $category )
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Quantity <span class="text-danger">*</span></label>
                                                <input type="number" placeholder="Quantity" class="form-control" required name="quantity">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Amount</label>
                                                <input type="number" class="form-control" name="amount" placeholder="Amount">
                                            </div>
                                        </div>
                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Invoice Number</label>
                                                <input type="text" class="form-control" name="invoice" placeholder="Invoice Number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Note</label>
                                                <textarea placeholder="Note" class="form-control" name="note"></textarea>
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
    <script>
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
                    $("#mobile").val(results.supplier.mobile);
                    $("#address").val(results.supplier.address);
                    console.log('data', results);
                }
            });
        });
    </script>
@endsection

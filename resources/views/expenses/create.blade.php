@extends('layouts.app')
@section('title')
    Create Expense
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
                        <h4>Create Expense</h4>
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

                                <form action="{{ route('expenses.store') }}" method="post">
                                    @csrf
                                   <div class="row mb-2">
                                     <div class="col-md-6 col-sm-12">
                                         <div class="form-group">
                                             <label class="control-label  mb-2">Expense Head <span class="text-danger">*</span></label>
                                             <select class="form-control" name="expenses_heads_id">
                                                 <option>Select Expense Head</option>
                                                 @foreach($heads as $head)
                                                     <option value="{{ $head->id }}">{{ $head->title }}</option>
                                                     @endforeach
                                             </select>
                                         </div>
                                     </div>
                                      <div class=" col-sm-12 col-md-6">
                                          <div class="form-group">
                                              <label class="control-label mb-2">Expense Date <span class="text-danger">*</span></label>
                                              <input type="date" class="form-control" name="date" required>

                                          </div>
                                      </div>
                                   </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label  mb-2">Title <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="title" placeholder="Expenses Head Title" required>

                                            </div>
                                        </div>
                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Amount <span class="text-danger">*</span></label>
                                                <input type="number" placeholder="Amount" class="form-control" required name="amount">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class=" col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-2">Note</label>
                                                <textarea aria-placeholder="Note" class="form-control" name="note"></textarea>

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

    </script>
@endsection
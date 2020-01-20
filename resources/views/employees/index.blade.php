@extends('layouts.app')
@section('title')
Manage Employees
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
                    <h4>Manage Employees</h4>
                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('employees.create') }}" class="btn btn-success btn-sm" title="Add New Category">
                                <i class="fa fa-plus" aria-hidden="true"></i> Add New
                            </a>
                            <br/>
                            <br/>

                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <form action="{{ route('employees.index') }}" method="get">
                                        {{ method_field('get') }}
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-3">

                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control select2" name="employee_id" id="customer_id">
                                                    <option value="">Select Employee Name</option>
                                                    @foreach($employees as $key=> $value)
                                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control select2" name="employee_mobile" id="customer_mobile">
                                                    <option value="">Select Mobile</option>
                                                    @foreach($employees as $key=>$value)
                                                        <option value="{{ $value->mobile }}">{{ $value->mobile }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-1">
                                                <span class="input-group-append">
                                                    <button class="btn btn-secondary btn-sm" type="submit">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr style="color: #00a78e">
                                            <th><i class="fa fa-list-ol" aria-hidden="true"></i>  SL</th>
                                            <th><i class="fa fa-user" aria-hidden="true"></i>  Name</th>
                                            <th><i class="fa fa-id-card" aria-hidden="true"></i>  Designation</th>
                                            <th><i class="fa fa-mobile" aria-hidden="true"></i>  Mobile</th>
                                            <th width="18%"><i class="fa fa-map-marker" aria-hidden="true"></i>  Address</th>
                                            <th><i class="fa fa-money" aria-hidden="true"></i>  Balance</th>
                                            <th><i class="fa fa-tasks" aria-hidden="true"></i>  Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                    $total = 0;
                                    @endphp
                                    @foreach($employees as $item)
                                        <tr>
                                            @php
                                            $total = $total + $item->balance;
                                            @endphp
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->designation }}</td>
                                            <td>{{ $item->mobile }}</td>
                                            <td>{{ $item->address }}</td>
                                            @if($item->balance)
                                                <td>TK-{{ $item->balance }}</td>
                                            @else
                                                <td>{{ $item->rate }}</td>
                                            @endif
                                            <td>
                                                <a href="{{ url('/employees/' . $item->id) }}" title="View Category"><button class="btn btn-info btn-sm"><i class="fa fa-book" aria-hidden="true"></i> Ledger</button></a>
                                                <a href="{{ url('/employees/' . $item->id . '/edit') }}" title="Edit Category"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#categoriesdelete-{{ $item->id }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Delete</button>

                                                <div id="categoriesdelete-{{ $item->id }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Delete Employees</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! Form::open([
                                                                    'method'=>'DELETE',
                                                                    'url' => ['/employees', $item->id],
                                                                    'class' => 'form-horizontal'
                                                                ]) !!}

                                                                    <div class="form-group">
                                                                        <label for="Role" class="control-label col-md-2">Password</label>
                                                                        <div class="col-md-10">
                                                                            <input type="password" class="form-control" name="password" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="Role" class="form-control-label col-md-2"></label>
                                                                        <div class="col-md-10">
                                                                            <button class="btn btn-primary" type="submit">Submit</button>
                                                                        </div>
                                                                    </div>

                                                                {!! Form::close() !!}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5" class="text-right">Total</td>
                                        <td>{{ $total }}</td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagination">
                                {{ $employees->links() }}
                            </div>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection

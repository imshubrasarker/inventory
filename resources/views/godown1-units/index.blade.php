@extends('layouts.app')
@section('title')
Units
@endsection
@section('content')
<div id="page-wrapper">
    <div class="main-page">
        @include('layouts.include.alert')
        <div class="forms">
            <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                <div class="form-title">
                    <h4>Manage Units</h4>
                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('godown-unit.create') }}" class="btn btn-success btn-sm" title="Add New Review">
                                <i class="fa fa-plus" aria-hidden="true"></i> Add New
                            </a>
                            <br/>
                            <br/>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Dozen Unit</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($dozens as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->unit_name }}</td>
                                            <td>{{ $item->unit_number }}</td>
                                            <td>
                                                <a href="{{ route('godown-unit.show', $item->id) }}" title="View Unit"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                                <a href="{{ route('godown-unit.edit', $item->id) }}" title="Edit Unit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#unitdelete-{{ $item->id }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Delete</button>

                                                <div id="unitdelete-{{ $item->id }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Delete Units</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! Form::open([
                                                                    'method'=>'DELETE',
                                                                    'url' => ['/godown-unit', $item->id],
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
                                    </tbody>
                                </table>
                                <div class="pagination-wrapper"> {!! $dozens->appends(['search' => Request::get('search')])->render() !!} </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

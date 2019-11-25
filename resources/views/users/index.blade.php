@extends('layouts.app')
@section('title')
Users
@endsection
@section('content')
<div id="page-wrapper">
    <div class="main-page">
        @include('layouts.include.alert')
        <div class="forms">
            <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                <div class="form-title">
                    <h4>Manage Users</h4>
                </div>
                <div class="form-body">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ url('users/create') }}" title="Back"><button class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add</button></a>
                            <br />
                            <br />
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->getRoleNames() }}</td>
                                            <td>
                                                @if($item->status == 1)
                                                    <a href="{{ url('/user-deactive/'.$item->id) }}" title="Deactivate"><button class="btn btn-sm btn-warning"><i class="fa fa-thumbs-down"></i></button></a>
                                                @else
                                                    <a href="{{ url('/user-active/'.$item->id) }}" title="Activate"><button class="btn btn-sm btn-success"><i class="fa fa-thumbs-up"></i></button></a>
                                                @endif
                                               {{--  <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button> --}}

                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal-{{ $item->id }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Assign Role</button>


                                                <div id="myModal-{{ $item->id }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Assign Role</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="form-horizontal" action="{{ route('assign-role') }}" method="post">
                                                                    @csrf

                                                                    <div class="form-group">
                                                                        <label for="Role" class="form-control-label col-md-1">Role</label>
                                                                        <div class="col-md-11">
                                                                            <select class="form-control" name="role" required="">
                                                                                <option value="">--Select Role--</option>
                                                                                @foreach($roles as $key => $value)
                                                                                <option value="{{ $value }}">{{ $value }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <input type="text" name="user_id" value="{{ $item->id }}">
                                                                    <div class="form-group">
                                                                        <label for="Role" class="form-control-label col-md-1"></label>
                                                                        <div class="col-md-11">
                                                                            <button class="btn btn-primary" type="submit">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <a href="{{ url('/users/'.$item->id) }}" title="View Unit"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>


                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#userdelete-{{ $item->id }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Delete</button>


                                                <div id="userdelete-{{ $item->id }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Delete User</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! Form::open([
                                                                    'method'=>'DELETE',
                                                                    'url' => ['/users', $item->id],
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
                                                
                                                {{-- {!! Form::open([
                                                    'method'=>'DELETE',
                                                    'url' => ['/users', $item->id],
                                                    'style' => 'display:inline'
                                                ]) !!}
                                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                            'type' => 'submit',
                                                            'class' => 'btn btn-danger btn-sm',
                                                            'title' => 'Delete Unit',
                                                            'onclick'=>'return confirm("Confirm delete?")'
                                                    )) !!}
                                                {!! Form::close() !!} --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{-- <div class="pagination-wrapper"> {!! $units->appends(['search' => Request::get('search')])->render() !!} </div> --}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

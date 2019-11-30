@extends('layouts.app')
@section('title')
    Expenses HEad
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
                        <h4>Create Expenses Head</h4>
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

                               <form action="{{ route('store-expenses-head') }}" method="post">
                                   @csrf
                                   <div class="form-group">
                                       <label class="control-label">Expenses Head Title</label>
                                       <input type="text" class="form-control" name="title" placeholder="Expenses Head Title" required>

                                   </div>
                                   <div class="form-group">
                                       <button class="btn btn-primary" type="submit">Create</button>
                                   </div>

                               </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="form-title ">
                    <h4>Expense Heads</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Created</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($expenses_heads as $head)
                            <tr>
                                <th scope="row">{{ $loop->index +1 }}</th>
                                <td>{{ $head->title }}</td>
                                <td>{{ Carbon\Carbon::parse($head->created_at)->format('d-M-Y ') }}</td>
                                <td>
                                    <button class="btn btn-primary" data-toggle="modal"
                                            data-target="#editModal"
                                            onclick="editHead('{{ $head->title }}','{{ route('edit-expense-head', $head->id) }}')">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                                    onclick="deleteHead('{{ route('delete-expense-head', $head->id) }}')">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('expenses.shared.edit-modal')
    @include('shared.delete-modal')

@endsection

@section('footer-script')
    <script>
        function editHead(title, route){
            $('#editHeadForm').attr("action", route);
            $("#head_title").val( title );
        }

        function deleteHead(route){
            $('#deleteForm').attr("action", route);
        }
    </script>
    @endsection
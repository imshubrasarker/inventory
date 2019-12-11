@extends('layouts.app')
@section('title')
    Manage Production
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
                        <h4>Manage Production</h4>
                    </div>
                    <div class="form-body">
                        <div class="card">
                            <div class="card-body">

                                <div style="overflow: hidden">
                                    <div class="float-left" style="float: left">
                                        <a href="{{ url('/home') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                                        <a href="{{ route('godown2.create') }}" class="btn btn-info btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>Add New</a>
                                    </div>
                                    <div class="float-right" style="float: right">
                                        <form class="navbar-form" role="search" action="{{ route('search.supplier') }}" method="get">
                                            @csrf
                                            <div class="input-group add-on">
                                                <input class="form-control" placeholder="Search" name="key" id="srch-term" type="text">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <br>
                                <br>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Size</th>
{{--                                            <th scope="col">Color</th>--}}
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Note</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($productions as $supplier)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td>{{ $supplier->name }}</td>
                                            <td>{{ $supplier->size }}</td>
{{--                                            <td>{{ $supplier->godownUnits->unit_name }}</td>--}}
                                            <td>{{ $supplier->qty }}</td>
                                            <td>{{ $supplier->note }}</td>
                                            <td>{{ $supplier->date }}</td>
                                            <td>
                                               <div class="row">
                                                   <div class="col-md-6">
                                                       <a href="{{ route('godown2.edit', $supplier->id) }}" type="button" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                                   </div>
                                                   <div class="col-sm-6">
                                                       <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                                                               onclick="deleteHead('{{ route('godown2.destroy', $supplier->id) }}')">
                                                           <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                       </button>
                                                   </div>
                                               </div>
                                            </td>
                                        </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="pagination">
                                        {{ $productions->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('shared.delete-modal')
@endsection

@section('footer-script')
    <script>
        function deleteHead(route){
            $('#deleteForm').attr("action", route);
        }
    </script>
@endsection

@extends('layouts.app')
@section('title')
    Expenses Head Details
@endsection
@section('header-script')
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="main-page">
            <a href="{{ route('expenses-head') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <br>
            <br>
            @include('layouts.include.alert')
            <div class="panel">
                <div class="form-title bg-light ">
                   <div class="row">
                       <div class="col-md-8">
                           <h4><strong>Expenses Head ({{ $head->title }}) </strong></h4>
                       </div>
                       <div class="col-md-4">
                           <h4>  <strong>Date: </strong>{{ Carbon\Carbon::parse($head->created_at)->format('d-M-Y') }}</h4>
                       </div>
                   </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col" width="20%">Title</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Note</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $total =0 ;
                            @endphp
                            @foreach($head->expenses as $expense)
                                @php
                                $total = $total + $expense->amount;
                                @endphp
                                <tr>
                                    <th scope="row">{{ $loop->index +1 }}</th>
                                    <td>{{ Carbon\Carbon::parse($expense->date)->format('d-M-Y ') }}</td>
                                    <td><a href="{{ route('expenses.show', $expense->id) }}">{{ $expense->title }}</a>
                                    </td>
                                    <td>{{ $expense->amount }}</td>
                                    <td>{{ $expense->note }}</td>
                                    <td>
                                        <a class="btn btn-primary"
                                           href="{{ route('expenses.edit', $expense->id) }}">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                                                onclick="deleteHead('{{ route('expenses.destroy', $expense->id) }}')">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="bg-light">
                                <td></td>
                                <td></td>
                                <td>Total Amount:</td>
                                <td  class="">
                                  {{ $total }}
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <br>
            </div>
        </div>
    </div>

@endsection

@extends('layouts.admin')
@section('title', 'All Categories')
@section('css')
@endsection
@section('content')

<div class="app-content content pt-2 pb-2" style="overflow: scroll;">
    <div class="col-12">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('failure'))
            <div class="alert alert-danger">
                {{ Session::get('failure') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All Categories ({{ $categories->count() }})</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <a href="{{ url('category/create') }}" class=""> Add Category ></a>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 20px">#</th>
                                    <th class="w-20">Name</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>
                                            <a href="{{ route('categor.courses', $category->id) }}" class="">{{ $category->name }}</a>
                                        </td>
                                        <td style="text-align: right; width:230px">
                                            <div class="form-group">
                                                <a href="{{ url('category/edit/'.$category->id) }}" class="">Edit </a>|
                                                <a href="{{ url('category/delete/'.$category->id) }}" class=" confirm"> Delete</a>
                                            </div>
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
</div>

@endsection
@section('script')
@endsection
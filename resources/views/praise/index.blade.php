@extends('layouts.admin')
@section('title', 'All Praises')
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
                <h4 class="card-title">All Praises ({{ $praises->count() }})</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <a href="{{ url('praise/create') }}" class=""> Add Praise ></a>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="w-20">Message</th>
                                    <th style="text-align: right; width:230px">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($praises as $praise)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{ $praise->msg }}</td>
                                        <td style="text-align: right; width:230px">
                                            <div class="form-group">
                                                <a href="{{ url('praise/edit/'.$praise->id) }}" class="">Edit </a>|
                                                <a href="{{ url('praise/delete/'.$praise->id) }}" class=" confirm"> Delete</a>
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
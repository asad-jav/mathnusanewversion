@extends('layouts.admin')
@section('title', 'All Topics')
@section('css')

@endsection
@section('content')

<div class="app-content content pt-2 pb-2">
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
                <h4 class="card-title">
                    <span class="badge badge-primary badge-lg p-1">{{ $course->title }}</span>
                </h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <a href="{{ route('courses') }}" class="">Courses</a>/
                        <a href="{{ route('topic.create', $course->id) }}" class=""> Add Topic</a>
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
                                    <th class="w-20">Title</th>
                                    <th class="w-20">Topic Index</th>
                                    <th class="w-20">Unpack Standards</th>
                                    <th class="w-20">Live Sessions</th>
                                    <th class="w-20">Objectives</th>
                                    <th style="text-align: right; width:230px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topics as $topic)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td><span class="text-ellipsis">{{ $topic->title }}</span></td>
                                        <td>{{ $topic->topic_index }}</td>
                                        <td>{{ $topic->unpack_standard }}</td>
                                        <td>{{ $topic->live_sessions }}</td>
                                        <td><span class="text-ellipsis">{{ $topic->objectives }}</span></td>
                                        <td style="text-align: right; width:230px">
                                            <div class="form-group">
                                                <a href="{{ route('topic.edit',$topic->id) }}" class="">Edit </a>|
                                                <a href="{{ route('topic.delete', $topic->id) }}" class=" confirm"> Delete</a>
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
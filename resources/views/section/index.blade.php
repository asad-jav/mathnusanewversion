@extends('layouts.admin')
@section('title', 'All Sections')
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
                    <span class="">All Sections</span>
                </h4>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <a href="{{ route('sections.create') }}" class="">Create Section ></a>
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
                                    <th style="width: 20px">Section Name</th>
                                    <th>Course Name</th>
                                    <th>Enroll limit</th>
                                    <th>Enroll Count</th>
                                    <th style="text-align: right; width:230px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sections as $section)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>
                                            <a href="{{route('sections.lectures', $section->id)}}">
                                                <span class="text-ellipsis">{{ $section->name }}</span>
                                            </a>
                                        </td>
                                        <td>
                                            @if ($section->course)
                                                {{ $section->course->title }}
                                            @endif
                                        </td>
                                        <td>{{ $section->max_enrollment }}</td>
                                        <td>{{ $section->enrollment_count }}</td>
                                        <td style="text-align: right; width:230px">
                                            <div class="form-group">
                                                <a href="{{ route('sections.edit', $section->id) }}" class="">Edit </a>|
                                                <a href="{{ route('sections.delete', $section->id) }}" class=" confirm"> Delete</a>
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
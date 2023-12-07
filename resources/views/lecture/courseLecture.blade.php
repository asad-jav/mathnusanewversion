@extends('layouts.admin')
@section('title', 'Course Lectures')
@section('css')
@endsection
@section('content')

<div class="app-content content page pt-2 pb-2" style="overflow: scroll;">
    <div class="">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Course: {{ $course_title }} ({{ $lectures->count() }})</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <a href="{{ url('lecture/create') }}" class=""> Create Lecture ></a>
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
                                    <th>Lecture</th>
                                    <th>Course</th>
                                    <th>Section</th>
                                    <th>Topic</th>
                                    <th>Duration</th>
                                    <th>Date & Time</th>
                                    <th>Lecture Number</th>
                                    <th>Status</th>
                                    <th class="text-right">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($lectures as $lecture)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $lecture->title }}</td>
                                        <td>{{ $lecture->course->title }}</td>
                                        <td>{{ $lecture->section->name }}</td>
                                        <td>{{ $lecture->topic->title }}</td>
                                        <td>{{ $lecture->duration }}</td>
                                        <td>{{ Carbon\Carbon::parse($lecture->datetime.' '.$lecture->start_time)->setTimezone(Auth::user()->timezone) }}</td>
                                        <td>{{ $lecture->lecture_number }}</td>
                                        <td>
                                            @if ($lecture->state == App\Lecture::ENDED)
                                                <span class="text-muted">Closed</span>
                                            @else
                                                <span class="text-success">Open</span>
                                            @endif
                                        </td>
                                        <td style="text-align: right; width:540px">
                                            <div class="form-group">
                                                <a href="{{ url('class/lecture/'.$lecture->id) }}" class="">Start Lecture</a> |
                                                <a href="{{ url('lecture/edit/'.$lecture->id) }}" class="">Edit</a> |
                                                <a href="{{ url('lecture/delete/'.$lecture->id) }}" class="confirm ">Delete</a>
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
</div>

@endsection
@section('script')
@endsection
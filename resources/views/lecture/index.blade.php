@extends('layouts.admin')
@section('title', 'All Lectures')
@section('css')
@endsection
@section('content')

<div class="app-content content pt-2 pb-2" style="overflow: scroll;">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All Lectures ( @if(!empty($lectures)){{ $lectures->count()}} @else 0 @endif)</h4>
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
                                    <th style="width:150px">Lecture</th>
                                    <th class="w-10">Course</th>
                                    <th class="w-10">Topic</th>
                                    <th class="w-10">Section</th>
                                    <th> Duration</th>
                                    <th style="width:200px">Date & Time</th>
                                    <th> Number</th>
                                    <th> Capacity</th>
                                    <th> Enrolled</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($lectures as $lecture)
                                    <tr>
                                        <td scope="row">{{ $i++ }}</td>
                                        <td>{{ $lecture->title }}</td>
                                        <td>{{ $lecture->course->title }}</td>
                                        <td>{{ $lecture->topic->title }}</td>
                                        <td>{{ $lecture->section->name }}</td>
                                        <td>{{ $lecture->duration }}</td>
                                        {{-- <td>{{ $lecture->datetime }}</td> --}}
                                        <td>{{ Carbon\Carbon::parse($lecture->datetime.' '.$lecture->start_time)->setTimezone(Auth::user()->timezone) }}</td>
                                        <td>{{ $lecture->lecture_number }}</td>
                                        <td>{{ $lecture->enrol_limit }}</td>
                                        <td>{{ $lecture->enrol_count }}</td>
                                        
                                        <td class="" style="text-align: right; width:300px">
                                            <div class="form-group">
                                                <a href="{{ url('class/lecture/'.$lecture->id) }}" class="">Start Lecture </a> |
                                                <a href="{{ url('lecture/edit/'.$lecture->id) }}" class=""> Edit </a> |
                                                <a href="{{ url('lecture/delete/'.$lecture->id) }}" class="confirm "> Delete </a>
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
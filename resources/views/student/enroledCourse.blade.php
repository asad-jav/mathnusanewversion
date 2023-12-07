@extends('layouts.admin')
@section('title', 'Enroled Courses')
@section('css')
@endsection
@section('content')

<div class="app-content content pt-2 pb-2" style="overflow: scroll;">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Enroled Courses ({{ $courses->count() }})</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="w-20">Title</th>
                                    <th class="w-10">Section</th>
                                    <th class="w-20">Category</th>
                                    <th class="w-10">Number of Lecture</th>
                                    <th class="w-10">Grade</th>
                                    <th class="w-10">Price</th>
                                    <th>Course Outline</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($courses as $course)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>
                                            {{-- <a href="{{ url('student/course/lecture/'.$course->id) }}">{{ $course->title }}</a> --}}
                                            <a href="{{ route('student.course.lecture', ['course_id'=>$course->id, 'section_id'=>$course->pivot->section_id]) }}" title="Goto topics">{{ $course->title }}</a>
                                        </td>
                                        <td>{{App\Section::getSectionNameById($course->pivot->section_id)}}</td>
                                        <td>{{ $course->category->name }}</td>
                                        <td>{{ $course->number_of_lectures }}</td>
                                        <td>{{ $course->grade->name }}</td>
                                        <td>
                                            {{ App\User::countrySpecificAmount($course) }} {{ App\User::countrySpecificSymbol() }}
                                        </td>
                                        <td>{{ $course->course_outline }}</td>
                                        
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
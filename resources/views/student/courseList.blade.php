@extends('layouts.admin')
@section('title', 'Student Courses')
@section('css')
@endsection
@section('content')

<div class="app-content content pt-2 pb-2" style="overflow: scroll;">
    
    <div class="col-12">
        @if (Session::has('success'))
            <div class="alert alert-success">
                <b>
                    {{ Session::get('success') }}
                </b>
            </div>
        @elseif(Session::has('danger'))
            <div class="alert alert-danger">
                <b>
                    {{ Session::get('danger') }}
                </b>
            </div>
        @endif
        
        
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Available Courses</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <a href="{{ url('student/course/enrolled') }}" class=""> Enrolled Courses ></a>
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
                                    <th class="w-20">Course Name</th>
                                    <th class="w-20">Category</th>
                                    <th class="w-10">Grade</th>
                                    <th class="w-10">Number of Lectures </th>
                                    <th class="w-10">Price </th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($courses as $course)
                                    
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{ $course->title }}</td>
                                        <td>{{ App\Models\Category::find($course->category_id)->name }}</td>
                                        <td>{{ App\Models\Grade::find($course->grade_id)->name }}</td>
                                        <td>{{ $course->number_of_lectures }}</td>
                                        <td>
                                            {{ App\Models\User::countrySpecificAmount($course) }} 
                                            {{ App\Models\User::countrySpecificSymbol() }}
                                        </td>
                                        <td style="text-align: right; width:230px">
                                            <div class="form-group">
                                                <form action="{{ route('payment') }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" value="dashboard" name="request">
                                                    <input type="hidden" name="type" value="{{ App\Models\Plan::COURSE }}">
                                                    <input type="hidden" name="course_id" id="course_id" value="{{ $course->id }}">
                                                    <button type="submit" class="btn btn-link">Buy</button>
                                                </form>
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
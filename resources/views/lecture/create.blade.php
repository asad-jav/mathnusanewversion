@extends('layouts.admin')
@section('title', 'Create Lecture')
@section('css')
@endsection
@section('content')

<div class="app-content content pt-2 pb-2" style="height:auto">
    
    <div class="col-12">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create Lecture</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <a href="{{ url('lecture/index') }}" class="">< Lecture List</a>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <form action="{{ url('lecture/store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="{{ old('title') }}">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Select Course</label>
                            <select name="course_id" id="course_id" class="form-control">
                                <option hidden value="">Select Course</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Select Topic</label>
                            <select name="topic" id="topic" class="form-control">
                                <option value="">Select topic</option>
                            </select>
                            @error('topic')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Select Section</label>
                            <select name="section" id="section" class="form-control">
                                <option value="">Select section</option>
                            </select>
                            @error('section')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Lecture Number</label>
                            <input type="number" name="lecture_number" id="lecture_number" class="form-control" placeholder="" value="{{ old('lecture_number') }}">
                            @error('lecture_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Outline</label>
                            <textarea name="outline" class="form-control" id="" cols="30" rows="10">{{ old('outline') }}</textarea>
                            @error('outline')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Duration</label>
                            <input type="number" name="duration" id="duration" min="1" class="form-control" placeholder="" value="{{ old('duration') }}">
                            @error('duration')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Date</label>
                            <input type="text" name="datetime" id="datetime" class="form-control datepicker" autocomplete="off" placeholder="Select date" value="{{ old('datetime') }}">
                            @error('datetime')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Start Time <small class="text-muted">(Pacific Standard Time Only)</small></label>
                            <input type="text" name="start_time" id="start_time" class="form-control time" autocomplete="off" placeholder="Select start time" value="{{ old('start_time') }}">
                            @error('start_time')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Create" placeholder="Lectures">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script>
        function fetchTopic(){
            var course = $('#course_id').val();
            var topic = $('#topic');
            if(course) {
                $.ajax({
                    url : "{{ url('dashboard/fetch/course/topics/') }}/"+course,
                    type : "GET",
                    dataType : "json",
                    success:function(data) {
                    topic.empty();
                        if(data.data) {
                            topic.html(data.data);
                        } else {
                            topic.html('<option value="" disabled>No topic found</option>');
                        }
                    }
                });
            } else {
                topic.empty();
            }
        }

        function fetchSection(){
            var course = $('#course_id').val();
            var section = $('#section');
            if(course) {
                $.ajax({
                    url : "{{ url('dashboard/fetch/course/sections/') }}/"+course,
                    type : "GET",
                    dataType : "json",
                    success:function(data) {
                    section.empty();
                        if(data.data) {
                            section.html(data.data);
                        } else {
                            section.html('<option value="" disabled>No section found</option>');
                        }
                    }
                });
            } else {
                section.empty();
            }
        }
        
        $('#course_id').on('change',function(){
            fetchTopic();
            fetchSection();
        });


    </script>
@endsection
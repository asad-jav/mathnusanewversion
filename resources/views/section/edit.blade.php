@extends('layouts.admin')
@section('title', 'Edit Section')
@section('css')
@endsection
@section('content')

<div class="app-content content pt-2 pb-2" >
    
    <div class="col-12">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header col-12">
                <h4 class="card-title">Edit Section </h4>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <a href="{{ route('sections') }}" class="">< All Sections</a>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('sections.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$section->id}}">
                                <div class="row">
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label for="desig">Course</label>
                                        <select name="course" id="course" class="form-control">
                                            <option value="">Select Course</option>
                                            @foreach ($courses as $course)
                                                <option value="{{$course->id}}">{{$course->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('course')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label for="desig">Section Name</label>
                                        <input type="Text" class="form-control" name="name" id="name" value="{{$section->name}}" placeholder="Section name">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary">
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script>
        @if($section->course_id)
            $('#course').val('{{$section->course_id}}')
        @endif
    </script>
@endsection
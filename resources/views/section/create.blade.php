@extends('layouts.admin')
@section('title', 'Add Section')
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
                <h4 class="card-title">Add Section </h4>
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
                            <form action="{{ route('sections.store') }}" method="POST">
                                @csrf
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
                                        <input type="Text" class="form-control" name="name" id="name" @if(Session::has('name')) value="{{Session::get('name')}}" @else value="{{old('name')}}" @endif placeholder="Section name">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        @if (Session::has('error'))
                                            <span class="text-danger">{{Session::get('error')}}</span>
                                        @endif
                                    </div>
                                    
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary">
                                            Create
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
        @if(Session::has('course'))
            $('#course').val('{{Session::get('course')}}');
        @else
            $('#course').val('{{Session::get('name')}}');
        @endif
    </script>
@endsection
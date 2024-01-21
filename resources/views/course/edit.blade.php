@extends('layouts.admin')
@section('title', 'Edit Course')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.css" integrity="sha512-m52YCZLrqQpQ+k+84rmWjrrkXAUrpl3HK0IO4/naRwp58pyr7rf5PO1DbI2/aFYwyeIH/8teS9HbLxVyGqDv/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')

<div class="app-content content pt-2 pb-2" style="overflow: scroll;">
    
    <div class="col-12">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Edit Courses</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <a href="{{ url('course/index') }}" class="">< Course List</a>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <form action="{{ url('course/update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" id="title" value="{{ $course->title }}" class="form-control" placeholder="Title">
                            <input type="hidden" name="id" id="id" value="{{ $course->id }}" class="form-control" placeholder="Title">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Select Category</label>
                            <select name="category" id="category" class="form-control">
                                <option value="" hidden>Select</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Number of Lectures</label>
                            <input type="number" min="1" name="number_of_lectures" id="number_of_lectures" value="{{ $course->number_of_lectures }}" class="form-control" placeholder="Lectures">
                            @error('number_of_lectures')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Grade</label>
                            {{-- <input type="number" min="1" name="number_of_lectures" value="{{ old('number_of_lectures') }}" id="number_of_lectures" class="form-control" placeholder="Lectures"> --}}
                            <select name="grade" id="grade" class="form-control">
                                <option value="" hidden>Select Grade</option>
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                @endforeach
                            </select>
                            @error('grade')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Amount in USD</label>
                            <input type="text" name="amount_in_usd" value="{{ $course->amount_in_usd }}" id="amount_in_usd" class="form-control" placeholder="Amount in USD">
                            @error('amount_in_usd')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Amount in KWD</label>
                            <input type="text" name="amount_in_kwd" value="{{ $course->amount_in_kwd }}" id="amount_in_kwd" class="form-control" placeholder="Amount in KD">
                            @error('amount_in_kwd')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Total Seats</label>
                            <input type="text" name="seats" value="{{ $course->seats }}" id="seats" class="form-control" placeholder="Total Number Of Seats">
                            @error('seats')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Course Start Date</label>
                            <input type="text" name="start_date" value="{{ $course->start_date }}" id="start_date" autocomplete="off" class="form-control datepicker" placeholder="Select Start Date">
                            @error('start_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Course End Date</label>
                            <input type="text" name="end_date" value="{{ $course->end_date }}" id="end_date" autocomplete="off" class="form-control datepicker" placeholder="Select End Date">
                            @error('end_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Course Outline</label> 
                            <textarea name="course_outline" id="" class="form-control summernote" placeholder="Outline" cols="30" rows="10">{{ $course->course_outline }}</textarea>
                            @error('course_outline')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image" class="btn btn-file w-100" id="file-label">Select Image</label>
                            <input type="file" name="image" id="image" class="form-control-file d-none" data-label="#file-label"><br>
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Update" placeholder="Lectures">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js" integrity="sha512-6rE6Bx6fCBpRXG/FWpQmvguMWDLWMQjPycXMr35Zx/HRD9nwySZswkkLksgyQcvrpYMx0FELLJVBvWFtubZhDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function() {
    $('.summernote').summernote();
});
</script>
<script>
    @if($course->grade->id)
        $('#grade').val('{{ $course->grade->id }}');
    @endif

    @if($course->category_id)
        $('#category').val("{{ $course->category_id }}")
    @endif

    $('#image').change(function(){
        var el = $(this);
        $(el.data('label')).html('Image selected');
        $(el.data('label')).css('color','green');
    });
</script>
@endsection
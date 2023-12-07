@extends('layouts.admin')
@section('title', 'Create Course')
@section('css')
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
                <h4 class="card-title">Create Courses </h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <a href="{{ url('course/index') }}" class="">< Course List</a>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <form action="{{ url('course/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" placeholder="Title">
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
                            <input type="number" min="1" name="number_of_lectures" value="{{ old('number_of_lectures') }}" id="number_of_lectures" class="form-control" placeholder="Lectures">
                            @error('number_of_lectures')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Grade</label>
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
                            <label for="">Course Price in USD</label>
                            <input type="text" name="amount_in_usd" value="{{ old('amount_in_usd') }}" id="amount_in_usd" class="form-control" placeholder="Amount in USD">
                            @error('amount_in_usd')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Course Price in KWD</label>
                            <input type="text" name="amount_in_kwd" value="{{ old('amount_in_kwd') }}" id="amount_in_kwd" class="form-control" placeholder="Amount in KD">
                            @error('amount_in_kwd')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Total Seats</label>
                            <input type="text" name="seats" value="{{ old('seats') }}" id="seats" class="form-control" placeholder="Total Number Of Seats">
                            @error('seats')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Course Start Date</label>
                            <input type="text" name="start_date" value="{{ old('start_date') }}" id="start_date" autocomplete="off" class="form-control datepicker" placeholder="Select Start Date">
                            @error('start_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Course End Date</label>
                            <input type="text" name="end_date" value="{{ old('end_date') }}" id="end_date" autocomplete="off" class="form-control datepicker" placeholder="Select End Date">
                            @error('end_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Course Outline</label>
                            <textarea name="course_outline" class="form-control" id="" cols="30" rows="10">{{ old('course_outline') }}</textarea>
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
    @if(old('grade', null) !== null)
        $('#grade').val("{{ old('grade') }}")
    @endif

    @if(old('category', null) !== null)
        $('#category').val("{{ old('category') }}")
    @endif

    $('#image').change(function(){
        var el = $(this);
        $(el.data('label')).html('Image selected');
        $(el.data('label')).css('color','green');
    });
</script>
@endsection
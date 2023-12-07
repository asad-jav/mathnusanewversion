@extends('layouts.admin')
@section('title', 'Add Package')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('public') }}/app-assets/vendors/css/forms/selects/select2.min.css">
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
                <h4 class="card-title">Edit Package </h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <a href="{{ route('packages') }}" class="">< Packages List</a>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <form action="{{ route('package.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="hidden" name="id" value="{{ $package->id }}">
                            <input type="text" name="title" id="title" value="{{ $package->title }}" class="form-control" placeholder="Give some title">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label for="">Select Plan</label>
                            <select name="plan_id" id="plan_id" class="form-control">
                                <option value="" hidden>Select Plan</option>
                                @foreach ($plans as $plan)
                                    <option value="{{ $plan->id }}">{{ $plan->title }}</option>
                                @endforeach
                            </select>
                            @error('plan_id')
                                <span class="text-danger">The plan field is required.</span>
                            @enderror
                        </div> --}}
                        <div class="form-group">
                            <label for="">Amount in USD</label>
                            <input type="text" name="amount_in_usd" id="amount_in_usd" value="{{ $package->amount_in_usd }}" class="form-control" placeholder="0.00">
                            @error('amount_in_usd')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Amount in KWD</label>
                            <input type="text" name="amount_in_kwd" id="amount_in_kwd" value="{{ $package->amount_in_kwd }}" class="form-control" placeholder="0.00">
                            @error('amount_in_kwd')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Select Grade</label>
                            <select class="select2 form-control grade" name="grade" id="grade" style="width:100%">
                                <option value="" hidden>Select grade</option>
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}" @if($grade->number == $package->grade->number) selected @endif>{{ $grade->name }}</option>
                                @endforeach
                            </select>
                            <p id="alert"></p>
                            @error('grade')
                                <span class="text-danger">Please select atleast one course</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Select Courses</label>
                            <select class="select2 form-control default-multiple " name="course_id[]" id="course_id" multiple="multiple" style="width:100%">
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}" @if($course->packages->contains($package->id)) selected @endif>{{ $course->title }}</option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <span class="text-danger">Please select atleast one course</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea type="text" name="description" id="description" rows="5" class="form-control" placeholder="Description">{{ $package->description }}</textarea>
                            @error('description')
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
                            <input type="submit" class="btn btn-primary" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('public') }}/app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Page JS-->
<script src="{{ asset('public') }}/app-assets/js/scripts/forms/select/form-select2.js" type="text/javascript"></script>
<!-- END: Page JS-->
<script>
    $('#image').change(function(){
        var el = $(this);
        $(el.data('label')).html('Image selected');
        $(el.data('label')).css('color','green');
    });

    $('#grade').on('change',function(){
        var grade = $(this).val();
        var courses = $('.default-multiple');
        if(grade) {
            $.ajax({
                url : "{{ url('grade/courses') }}/"+grade,
                type : "GET",
                dataType : "json",
                success:function(data) {
                    console.log(data);
                    courses.empty();
                    if(data.data) {
                        courses.html(data.data);
                    } else {
                        courses.html('<option value="" disabled>No course found</option>');
                    }
                }
            });
        } else {
            courses.empty();
        }
    });
</script>
@endsection
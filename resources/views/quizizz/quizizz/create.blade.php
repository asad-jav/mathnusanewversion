@extends('layouts.admin')
@section('title', 'Create New Quizizz')
@section('css')
<style>
    .right {
        float: right !important;
    }

    .left {
        float: left !important;
    }

    .alert-danger {
        color: #f44336 !important;
        background-color: #fee0e19c !important;
        border-color: #fed3d6 !important;
    }
</style>
@endsection
@section('content')

<div class="app-content content pt-2 pb-2">
    <div class="col-12">
        @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
        @endif
        @if (Session::has('failure'))
        <div class="alert alert-danger">
            {{ Session::get('failure') }}
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <span class="">Create New Quizizz</span>
                </h4>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <form action="{{route('quizizz.store')}}" method="Post" class="form-horizontal">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="control-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" value="{{old('title')}}" maxlength="50">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="grade" class="control-label">Grade</label>
                                    <select type="text" class="form-control" id="grade" name="grade">
                                        <option value="">--Select Grade--</option>
                                        @foreach($grades as $grade)
                                        <option value="{{$grade->id}}" {{old('grade' == $grade->id ? 'selected' : '')}}>{{$grade->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('grade')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="course" class="control-label">Course</label>
                                    <select type="text" class="form-control" id="course" name="course">
                                        <option value="">--Select course--</option>
                                    </select>

                                    @error('course')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="standards" class="control-label">Standards</label>
                                    <select type="text" class="form-control" id="standards" name="standards">
                                        <option value="">--Select standards--</option>
                                    </select>

                                    @error('standards')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="timer" class="control-label">Quiz Start Date </label>
                                    <input type="date" class="form-control" id="start-date" name="start_date" value="{{old('start_date')}}">
                                    @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="timer" class="control-label">Quiz End Date </label>
                                    <input type="date" class="form-control" id="end-date" name="end_date" value="{{old('end_date')}}">
                                    @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status" class="control-label">Status</label>
                                    <select type="text" class="form-control" id="status" name="status">
                                        <option value="0" {{old('status') == 0 ? 'selected' : ''}}>Disable</option>
                                        <option value="1" {{old('status') == 1 ? 'selected' : ''}}>Enable</option>
                                        <option value="2" {{old('status') == 2 ? 'selected' : ''}}>Complete</option>
                                        @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="status" class="control-label">Total Passing Marks</label>
                                    <input type="number" class="form-control" id="passing-marks" name="passing_marks" value="{{old('passing_marks')}}">
                                    @error('passing_marks')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea id="description" name="description" placeholder="Enter Description" class="form-control">{{old('description')}}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn btn-secondary right mb-4" id="saveBtn" value="create">Save changes
                            </button>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="openStandard" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body"id="standard_description"> 
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(function() {

        /*------------------------------------------
         --------------------------------------------
         Pass Header Token
         --------------------------------------------
         --------------------------------------------*/
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });

        /*------------------------------------------
         --------------------------------------------
         Click to Edit Button
         --------------------------------------------
         --------------------------------------------*/

        function getCourses() {
            let grade_id = $('#grade').val();
            if (grade_id) {
                $.ajax({
                    url: "{{ route('get-grade-courses') }}",
                    type: "GET",
                    data: {
                        grade: grade_id
                    },
                    success: function(data) {
                        // Clear the existing options in the "Course" dropdown
                        $('#course').empty();
                        // Clear the existing options in the "Course" dropdown
                        $('#standards').empty();
                        $('#course').append($('<option>', {
                            value: '',
                            text: '--Select course--'
                        })); 
                        $('#standards').append($('<option>', {
                            value: '',
                            text: '--Select standard--'
                        }));
                        // Populate the "Course" dropdown with the received data
                        $.each(data.courses, function(key, value) {
                            $('#course').append($('<option>', {
                                value: value.id,
                                text: value.title
                            }));
                        });
                        // Populate the "Course" dropdown with the received data
                        $.each(data.standards, function(key, value) {
                            $('#standards').append($('<option>', {
                                value: value.id,
                                text: value.title
                            }));
                        });
                    },
                    error: function() {
                        console.log('An error occurred');
                    }
                });
            } else {
                // If no grade is selected, clear the "Course" dropdown
                $('#course').empty();
                $('#course').append($('<option>', {
                    value: '',
                    text: '--Select course--'
                }));
                $('#standards').empty();
                $('#standards').append($('<option>', {
                    value: '',
                    text: '--Select standard--'
                }));
            }
        }

 

        $(document).on('change', '#grade', function() {
            getCourses(); 
        });

        $(document).on('change', '#standards', function() {
            let standards = $('#standards').val();
            if (standards) {
                $.ajax({
                    url: "{{ route('get_standard_detail') }}",
                    type: "GET",
                    data: {
                        standards: standards
                    },
                    success: function(data) { 
                        // Clear the existing options in the "Course" dropdown
                        if(data.status == 'success'){
                            $("#openStandard").modal('show');
                            $("#standard_description").html('');
                            $("#standard_description").html(data.standard.description);
                        }
                    },
                    error: function() {
                        console.log('An error occurred');
                    }
                });
            } else {
               
            } 
        });


    });


    /*------------------------------------------
    --------------------------------------------
    printErrorMsg Code
    --------------------------------------------
    --------------------------------------------*/
    function printErrorMsg(msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display', 'block');
        $.each(msg, function(key, value) {
            $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
        });
    }
</Script>
@endsection
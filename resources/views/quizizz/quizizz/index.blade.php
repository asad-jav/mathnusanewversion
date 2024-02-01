@extends('layouts.admin')
@section('title', 'All CFU')
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
        @if (session('status') == 'success')
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        @if (session('status') == 'failure')
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <span class="">All CFU</span>
                </h4>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <a href="{{route('quizizz.create')}}" class="btn btn-primary"><i class="ft-plus"></i> Create CFU</a>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <div class="toast" role="toast" aria-live="assertive" aria-atomic="true" data-delay="5000">
                        <div class="toast-header">
                            <strong class="mr-auto">Success</strong>
                            <button type="button" class="ml-1 close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="toast-body">

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table data-table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Course</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Passing Marks</th>
                                    <th>Status</th>
                                    <th>Description</th>
                                    <th width="280px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
            </div>
            <div class="modal-body">
                <div class="print-error-msg alert-danger" style="display:none">
                    <ul></ul>
                </div>
                <form id="quizizzForm" name="quizizzForm" class="form-horizontal">
                    <input type="hidden" name="quizizz_id" id="quizizz_id">
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="form-group">
                                <label for="name" class="control-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" value="" maxlength="50">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="grade" class="control-label">Grade</label>
                                <select type="text" class="form-control" id="grade" name="grade">
                                    <option value="">--Select Grade--</option>
                                    @foreach($grades as $grade)
                                    <option value="{{$grade->id}}">{{$grade->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="course" class="control-label">Course</label>
                                <select type="text" class="form-control" id="course" name="course">
                                    <option value="">--Select course--</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="timer" class="control-label">CFU Start Date </label>
                                <input type="date" class="form-control" id="start-date" name="start_date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="timer" class="control-label">CFU End Date </label>
                                <input type="date" class="form-control" id="end-date" name="end_date">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status" class="control-label">Status</label>
                        <select type="text" class="form-control" id="status" name="status">
                            <option value="0">Disable</option>
                            <option value="1">Enable</option>
                            <option value="2">Complete</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status" class="control-label">Total Passing Marks</label>
                        <input type="number" class="form-control" id="passing-marks" name="passing_marks">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Description</label>
                        <textarea id="description" name="description" placeholder="Enter Description" class="form-control"></textarea>

                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn btn-secondary right" id="saveBtn" value="create">Save changes
                        </button>
                    </div>
                </form>
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
        Render DataTable
        --------------------------------------------
        --------------------------------------------*/
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('quizizz.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'course',
                    name: 'course.title'
                },
                {
                    data: 'start_date',
                    name: 'Start Date'
                },
                {
                    data: 'end_date',
                    name: 'End Date'
                },
                {
                    data: 'passing_marks',
                    name: 'Passing Marks',
                },
                {
                    data: 'status',
                    name: 'Status'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
      
        /*------------------------------------------
         --------------------------------------------
         Click to Edit Button
         --------------------------------------------
         --------------------------------------------*/

        function getCourses()
        {
            let grade_id = $('#grade').val();
            if (grade_id) {
                $.ajax({
                    url: "{{ route('get-grade-courses') }}",
                    type: "GET",
                    data: { grade: grade_id },
                    success: function(data) {
                        // Clear the existing options in the "Course" dropdown
                        $('#course').empty();
                        // Populate the "Course" dropdown with the received data
                        $.each(data.courses, function(key, value) {
                            $('#course').append($('<option>', {
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
            }
        }
 

 
        $(document).on('change', '#grade', function() {
            getCourses();
        });
        


        /*------------------------------------------
    --------------------------------------------
    Delete post Code
    --------------------------------------------
    --------------------------------------------*/
        $('body').on('click', '.deleteQuizizz', function() {

            var quizizz_id = $(this).data("id");
            confirm("Are You sure want to delete !");

            $.ajax({
                type: "DELETE",
                url: "{{ route('quizizz.store') }}" + '/' + quizizz_id,
                success: function(data) {
                    table.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
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
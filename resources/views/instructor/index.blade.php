@extends('layouts.admin')
@section('title', 'All Instructors')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/vendors/css/forms/selects/select2.min.css') }}">
<style>
    .select2-container--default .select2-search--inline .select2-search__field{
        padding-left: 36px;
    }
</style>
@endsection
@section('content')

<div class="app-content content pt-2 pb-2" style="overflow: scroll;">
    <div class="col-12">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif
        @if (Session::has('failure'))
            <div class="alert alert-danger">
                {{Session::get('failure')}}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Instructors</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <a href="#" class="btn btn-primary py-1 px-1 box-shadow-1" data-toggle="modal" data-target="#addInstructor">Add Instructor</a>
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>contact</th>
                                    <th>Country</th>
                                    <th>Reg Type</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($instructors as $instructor)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$instructor->first_name}} {{$instructor->last_name}}</td>
                                        
                                        <td>{{$instructor->email}}</td>
                                        <td>{{$instructor->contact}}</td>
                                        <td>{{$instructor->country}}</td>
                                        <td>
                                            @if ($instructor->registration_type == App\Models\Instructor::ADMIN_PREFERRED)
                                                Admin Preferred
                                            @endif
                                        </td>
                                        <td>
                                            @if ($instructor->status == App\Models\Instructor::APPROVED)
                                                <span class="text-success">Approved</span>
                                            @elseif($instructor->status == App\Models\Instructor::BLOCKED)
                                                <span class="text-danger">Blocked</span>
                                            @else
                                                <span class="text-primary">Approval Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.instructors.assign.courses.form', ['user_id' => $instructor->id])}}" class="btn btn-icon btn-outline-success btn-sm edit"><i class="ft-user-check"></i></a>
                                            <a href="{{route('admin.instructors.edit', $instructor->id)}}" class="btn btn-icon btn-outline-purple btn-sm edit"><i class="ft-edit"></i></a>
                                            <a href="{{route('admin.instructors.delete', $instructor->id)}}" class="confirm btn btn-icon btn-outline-danger btn-sm"><i class="ft-trash"></i></a>
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

<!-- Add Instructor Modal -->
<div class="modal fade" id="addInstructor" tabindex="-1" role="dialog" aria-labelledby="addInstructorLabel" aria-hidden="true" data-backdrop="static" data-keyboard='false'>
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header border-bottom bg-primary py-2">
          <h5 class="modal-title text-white" id="addInstructorLabel">Add Instructor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" action="{{ route('admin.instructors.store') }}" method="POST" novalidate enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{App\Models\Instructor::ADMIN_PREFERRED}}" name="reg_type">
                <input type="hidden" value="{{App\Models\Instructor::APPROVED}}" name="status">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                    <label for="">First Name</label>
                        <fieldset class="form-group position-relative has-icon-left">
                            <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control @error('first_name') is-invalid @enderror" id="user-name" placeholder="Instructor's First Name">
                            <div class="form-control-position">
                                <i class="ft-user"></i>
                            </div>
                            @error('first_name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <label for="">Last Name</label>
                        <fieldset class="form-group position-relative has-icon-left">
                            <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control @error('last_name') is-invalid @enderror" id="user-name" placeholder="Instructor's Last Name">
                            <div class="form-control-position">
                                <i class="ft-user"></i>
                            </div>
                            @error('last_name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <label for="">Email</label>
                        <fieldset class="form-group position-relative has-icon-left">
                            <input type="text" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="user-name" placeholder="Instructor Email">
                            <div class="form-control-position">
                                <i class="ft-mail"></i>
                            </div>
                            @error('email')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <label for="">Gender</label>
                        <fieldset class="form-group position-relative has-icon-left">
                            <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="gender">
                                <option value="" hidden>Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <div class="form-control-position">
                                <i class="la la-transgender"></i>
                            </div>
                            @error('gender')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-md-6 col-lg-6">
                        <label for="">Date of Birth</label>
                        <fieldset class="form-group position-relative has-icon-left ">
                            <input type="text" name="dob" id="dob" value="{{ old('dob') }}" class="form-control datepicker @error('dob') is-invalid @enderror" placeholder="Date of Birth" autocomplete="off">
                            <div class="form-control-position">
                                <i class="ft-calendar"></i>
                            </div>
                            @error('dob')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <label for="">Contact</label>
                        <fieldset class="form-group position-relative has-icon-left">
                            <input type="text" name="contact" value="{{ old('contact') }}" class="form-control @error('contact') is-invalid @enderror" id="contact" placeholder="Phone number">
                            <div class="form-control-position">
                                <i class="ft-phone"></i>
                            </div>
                            @error('contact')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <label for="">Country</label>
                        <fieldset class="form-group position-relative has-icon-left">
                            <x-country name="country" class="country form-control" id="country"/>
                            <div class="form-control-position">
                                <i class="ft-flag"></i>
                            </div>
                            @error('country')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <label for="">Timezone</label>
                        <fieldset class="form-group position-relative has-icon-left">
                            <x-timezones name="timezone" class="form-control timezone" id="timezone"/>
                            <div class="form-control-position">
                                <i class="ft-phone"></i>
                            </div>
                            @error('timezone')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="">School</label>
                        <fieldset class="form-group position-relative has-icon-left">
                            <select name="school" class="form-control @error('course') is-invalid @enderror" id="school">
                                <option value="">Select school</option>
                                <option value="Elementory">Elementory</option>
                                <option value="Middle">Middle</option>
                                <option value="High">High</option>
                            </select>
                            <div class="form-control-position">
                                <i class="la la-home"></i>
                            </div>
                            @error('school')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <label for="">Instructor Image</label>
                        <fieldset class="form-group position-relative has-icon-left">
                            <input type="file" name="file" id="file" class="form-control-file">
                            @error('image')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-glow" >Register</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>

<!-- Edit Instructor Modal -->
<div class="modal fade" id="editInstructor" tabindex="-1" role="dialog" aria-labelledby="editInstructorLabel" aria-hidden="true" data-backdrop="static" data-keyboard='false'>
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header border-bottom bg-primary py-2">
          <h5 class="modal-title text-white" id="editInstructorLabel">Edit Instructor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" action="{{ route('admin.instructors.store') }}" method="POST" novalidate id="edit-form">
                @csrf
                <input type="hidden" value="{{App\Models\Instructor::ADMIN_PREFERRED}}" name="reg_type">
                <input type="hidden" value="{{App\Models\Instructor::APPROVED}}" name="status">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <fieldset class="form-group position-relative has-icon-left">
                            <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control @error('first_name') is-invalid @enderror" id="fname" placeholder="Instructor's First Name">
                            <div class="form-control-position">
                                <i class="ft-user"></i>
                            </div>
                            @error('first_name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <fieldset class="form-group position-relative has-icon-left">
                            <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control @error('last_name') is-invalid @enderror" id="lname" placeholder="Instructor's Last Name">
                            <div class="form-control-position">
                                <i class="ft-user"></i>
                            </div>
                            @error('last_name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <fieldset class="form-group position-relative has-icon-left">
                            <input type="text" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="edit-email" placeholder="Instructor Email">
                            <div class="form-control-position">
                                <i class="ft-mail"></i>
                            </div>
                            @error('email')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <fieldset class="form-group position-relative has-icon-left">
                            <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="edit-gender">
                                <option value="" hidden>Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <div class="form-control-position">
                                <i class="la la-transgender"></i>
                            </div>
                            @error('gender')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-md-6 col-lg-6">
                        <fieldset class="form-group position-relative has-icon-left ">
                            <input type="text" name="dob" id="edit-dob" value="{{ old('dob') }}" class="form-control datepicker @error('dob') is-invalid @enderror" placeholder="Date of Birth" autocomplete="off">
                            <div class="form-control-position">
                                <i class="ft-calendar"></i>
                            </div>
                            @error('dob')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <fieldset class="form-group position-relative has-icon-left">
                            <input type="text" name="contact" value="{{ old('contact') }}" class="form-control @error('contact') is-invalid @enderror" id="edit-contact" placeholder="Phone number">
                            <div class="form-control-position">
                                <i class="ft-phone"></i>
                            </div>
                            @error('contact')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <fieldset class="form-group position-relative has-icon-left">
                            <x-country name="country" class="country form-control" id="edit-country"/>
                            <div class="form-control-position">
                                <i class="ft-flag"></i>
                            </div>
                            @error('country')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <fieldset class="form-group position-relative has-icon-left">
                            <x-timezones name="timezone" class="form-control timezone" id="edit-timezone"/>
                            <div class="form-control-position">
                                <i class="ft-phone"></i>
                            </div>
                            @error('timezone')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <fieldset class="form-group position-relative has-icon-left">
                            <select name="course" class="form-control @error('course') is-invalid @enderror" id="editCourse" data-target="#editSection">
                                <option value="" hidden>Select Course</option>
                                @foreach ($courses as $course)
                                    <option value="{{$course->id}}">{{$course->title}}</option>
                                @endforeach
                            </select>
                            <div class="form-control-position">
                                <i class="la la-book"></i>
                            </div>
                            @error('course')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <fieldset class="form-group position-relative has-icon-left">
                            <select name="section" id="editSection" class="form-control">
                                <option value="">Select section</option>
                            </select>
                            <div class="form-control-position">
                                <i class="la la-sitemap"></i>
                            </div>
                            @error('section')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </fieldset>
                    </div>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-bg-gradient-x-purple-blue btn-block btn-glow col-12 mr-1 mb-1" >Register</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>

@endsection
@section('script')
<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('backend/app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Page JS-->
<script src="{{ asset('backend/app-assets/js/scripts/forms/select/form-select2.js') }}" type="text/javascript"></script>
<!-- END: Page JS-->
    <script>
        $('#addCourse').select2({
            placeholder: "Select a courses",
        });
        function fetchSection(el){
            var course = el.val();
            var section_id = el.data('target');
            var section = $(section_id);
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

        @if($errors->any())
            $('#addInstructor').modal('show');
        @endif

        @if(old('school'))
            $('#school').val('{{old('school')}}');
        @endif
        
        $('#addCourse').on('change',function(){
            fetchSection($(this));
        });

        $('#editCourse').on('change',function(){
            fetchSection($(this));
        });

        $('.edit').click(function(){
            var el = $(this).data('object');
            $('#fname').val(el.first_name);
            $('#lname').val(el.last_name);
            $('#edit-email').val(el.email);
            $('#edit-contact').val(el.contact);
            $('#edit-gender').val(el.gender);
            $('#edit-dob').val(el.dob);
            $('#edit-country').val(el.country);
            $('#edit-timezone').val(el.timezone);
            $('#editCourse').val(30);
            console.log(el.courses);
        });
    </script>
@endsection
@extends('layouts.admin')
@section('title', 'Edit Instructors')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/vendors/css/forms/selects/select2.min.css')}}">
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
                <h4 class="card-title">Edit Instructor</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <a href="{{route('admin.instructors')}}" class="" >< Instructor List</a>
                    </ul>
                </div>
            </div>
            
            <div class="card-content collapse show">
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('admin.instructors.update') }}" method="POST" novalidate id="edit-form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$instructor->id}}" name="id">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <label for="">First Name</label>
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input type="text" name="first_name" value="{{$instructor->first_name}}" class="form-control @error('first_name') is-invalid @enderror" id="fname" placeholder="Instructor's First Name">
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
                                    <input type="text" name="last_name" value="{{$instructor->last_name}}" class="form-control @error('last_name') is-invalid @enderror" id="lname" placeholder="Instructor's Last Name">
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
                                    <input type="text" name="email" value="{{ $instructor->email }}" class="form-control @error('email') is-invalid @enderror" id="edit-email" placeholder="Instructor Email" readonly>
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
                                <label for="">Date of Birth</label>
                                <fieldset class="form-group position-relative has-icon-left ">
                                    <input type="text" name="dob" id="edit-dob" value="{{$instructor->dob}}" class="form-control datepicker @error('dob') is-invalid @enderror" placeholder="Date of Birth" autocomplete="off">
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
                                    <input type="text" name="contact" value="{{ $instructor->contact }}" class="form-control @error('contact') is-invalid @enderror" id="edit-contact" placeholder="Phone number">
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
                                <label for="">Timezone</label>
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
                            <button type="submit" class="btn btn-primary btn-glow " >Update</button>
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
<script src="{{ asset('backend/app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Page JS-->
<script src="{{ asset('backend/app-assets/js/scripts/forms/select/form-select2.js') }}" type="text/javascript"></script>
<!-- END: Page JS-->
    <script>
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
        
        $('#addCourse').on('change',function(){
            fetchSection($(this));
        });

        $('#editCourse').select2({
            placeholder:'Please select courses'
        });

        $('#editCourse').on('change',function(){
            fetchSection($(this));
        });

        @if($instructor->country !== '')
            $('#edit-country').val("{{ $instructor->country }}")
        @endif

        @if($instructor->timezone !== '')
            $('#edit-timezone').val("{{ $instructor->timezone }}")
        @endif

        @if(isset($instructor->gender))
            $('#edit-gender').val("{{ $instructor->gender }}");
        @endif

        @if($instructor->country !== '')
            $('#school').val("{{ $instructor->school }}")
        @endif

    </script>
@endsection
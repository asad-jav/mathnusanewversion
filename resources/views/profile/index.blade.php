@extends('layouts.admin')
@section('title', Auth::user()->first_name."'s Profile")
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
                <h4 class="card-title">Profile Image </h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form id="id_dropzone"
                                class="dropzone"
                                action="{{ url('profile/update/avatar') }}"
                                enctype="multipart/form-data"
                                method="post">
                                @csrf
                            </form>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="form-group">
                                <button id="upload-single" class="btn btn-primary sendFiles">Upload</button>
                                {{-- <button id="clear-dropzone-single" class="btn btn-secondary clear-dropzone">Reset</button> --}}
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">User Profile </h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <form action="{{ url('profile/update') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">First Name</label>
                                    <input type="text" name="first_name" id="first_name" value="{{ Auth::user()->first_name }}" class="form-control">
                                    <input type="hidden" name="id" value="{{ Auth::id() }}">
                                    @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" value="{{ Auth::user()->last_name }}" class="form-control">
                                    @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" name="email" id="email" readonly value="{{ Auth::user()->email }}" class="form-control">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Gender</label>
                                    <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="gender">
                                        <option value="" hidden>Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                    @error('gender')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Country</label>
                                    <x-country name="country" class="country form-control" id="country"/>
                                    @error('gender')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Contact</label>
                                    <input type="text" name="contact" id="contact" value="{{ Auth::user()->contact }}" class="form-control">
                                    @error('contact')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Date Of Birth</label>
                                    <input type="text" name="dob" id="dob" value="{{ Auth::user()->dob }}" class="form-control datepicker  @error('dob') is-invalid @enderror" style="padding-left: 20px" placeholder="Date of Birth" autocomplete="off">
                                    @error('dob')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @can ('student')
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Grade</label>
                                        <select name="grade" id="grade" class="form-control">
                                            @foreach ($grades as $grade)
                                                <option value="{{ $grade->id }}" @if(Auth::user()->grade_id == $grade->id) selected @endif>{{ $grade->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('gender')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endcan
                            @can ('teacher')
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">School</label>
                                    <select name="school" class="form-control @error('course') is-invalid @enderror" id="school">
                                        <option value="">Select school</option>
                                        <option value="Elementory">Elementory</option>
                                        <option value="Middle">Middle</option>
                                        <option value="High">High</option>
                                    </select>

                                    @error('school')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @endcan

                            <div class="@if(Auth::user()->roles[0]->slug != 'admin') col-12 @else col-6 @endif">
                                <div class="form-group">
                                    <label for="">Timezone</label>
                                    <x-timezones name="timezone" class="form-control timezone" id="timezone"/>
                                    @error('gender')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Update Profile" placeholder="Lectures">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Change Password </h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <form action="{{ url('profile/update/password') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Previous Password</label>
                                    <input type="password" name="previous_password" id="previous_password" value="" class="form-control">
                                    @error('previous_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @if (Session::has('previous_password'))
                                        <span class="text-danger">{{ Session::get('previous_password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">New Password</label>
                                    <input type="password" name="password" id="password" value="" class="form-control">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Update Password" placeholder="Lectures">
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
        @if (Auth::check()) 
            $('#gender').val("{{ Auth::user()->gender }}")
        @endif

        @if (Auth::check())
            $('#school').val("{{ Auth::user()->school }}")
        @endif

    
        @if (Auth::check()) 
            $(document).ready(function(){
                $('.country').val("{{ Auth::user()->country }}");
            });
        @endif

        @if (Auth::check()) 
            $(document).ready(function(){
                $('#timezone').val("{{ Auth::user()->timezone }}");
            });
        @endif

        @if (Session::has('previous_password'))
            $('#previous_password').focus();
        @endif
        
    </script>
@endsection
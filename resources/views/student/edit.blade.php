@extends('layouts.student')
@section('title', 'Edit Student')
@section('css')
    
@endsection

@section('content')
    <div class="app-content content pt-2 pb-2" style="overflow: scroll;">
        <div class="col-12">
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if (Session::has('danger'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('danger') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Student</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            {{-- <a href="{{ url('course/create') }}" class="btn btn-link"> Create Course ></a> --}}
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ url('student/update') }}" method="POST" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="text" name="first_name" value="{{ $student->first_name }}" class="form-control  @error('first_name') is-invalid @enderror" id="user-name" placeholder="Your First Name">
                                        <input type="hidden" name="id" value="{{ $student->id }}">
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
                                        <input type="text" name="last_name" value="{{$student->last_name }}" class="form-control  @error('last_name') is-invalid @enderror" id="user-name" placeholder="Your Last Name">
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
                                        <input type="text" readonly value="{{ $student->email }}" class="form-control  @error('email') is-invalid @enderror" id="user-name" placeholder="Your Email">
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
                                        <select name="gender" class="form-control  @error('gender') is-invalid @enderror" id="gender">
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
                                <div class="col-md-6 col-lg-6" id="pickadate">
                                    <fieldset class="form-group position-relative has-icon-left ">
                                        <input type="text" name="dob" id="dob" value="{{ $student->dob }}" class="form-control datepicker  @error('dob') is-invalid @enderror" placeholder="Date of Birth" autocomplete="off">
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
                                        <input type="number" min="3" max="12" name="grade" id="grade" value="{{ $student->grade }}" class="form-control  @error('grade') is-invalid @enderror" placeholder="select your grade">
                                        <div class="form-control-position" >
                                            <i class="ft-award"></i>
                                        </div>
                                        @error('grade')
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
                                        <x-country name="country" class="country form-control " id="country"/>
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
                                        <input type="text" name="contact" value="{{ $student->contact }}" class="form-control  @error('contact') is-invalid @enderror" id="contact" placeholder="Phone number">
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
                                <div class="col-md-6">
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <x-timezones name="timezone" class="form-control timezone " id="timezone"/>
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
                                <div class="col-md-6">
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="number" value="{{ $student->coins}}" name="coins" class="form-control" id="coins"/>
                                        <div class="form-control-position">
                                            <i class="ft-dollar">$</i>
                                        </div>
                                        @error('coins')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mr-1 mb-1">Update</button>
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
        @if($student->country !== '')
            $('#country').val("{{ $student->country }}")
        @endif

        @if($student->timezone !== '')
            $('#timezone').val("{{ $student->timezone }}")
        @endif

        @if(isset($student->gender))
            $('#gender').val("{{ $student->gender }}");
        @endif
    </script>
@endsection
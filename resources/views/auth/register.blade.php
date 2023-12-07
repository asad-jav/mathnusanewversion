@extends('layouts.auth')
@section('title', 'Student - Registration')
@section('css')
    <style>
        @media screen and (max-width:767px) {
            .img-auto-adjust{
                width: 100%;
            }
        }
    </style>
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper min-vh-100">
            <div class="content-wrapper-before"></div>
            <div class="content-header"></div>
            <div class="content-body min-vh-100">
                <section class="flexbox-container min-vh-100 overflow" id="daterange">
                    <div class="col-12 d-flex  justify-content-center">
                        <div class="col-lg-6 col-md-8 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                                <div class="card-header border-0">
                                    <div class="text-center mb-1">
                                        <img src="{{ asset('backend/app-assets/images/logo/logo.png')}}" class="img-auto-adjust" alt="branding logo">
                                    </div>
                                    <div class="font-large-1 text-center">
                                        <h3>Sign Up</h3>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body" style="padding-bottom: 0">
                                        <form class="form-horizontal" action="{{ route('register') }}" method="POST" novalidate>
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6">
                                                    <fieldset class="form-group position-relative has-icon-left">
                                                        <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control @error('first_name') is-invalid @enderror" id="user-name" placeholder="Student's First Name">
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
                                                        <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control @error('last_name') is-invalid @enderror" id="user-name" placeholder="Student's Last Name">
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
                                                        <input type="text" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="user-name" placeholder="Your Email">
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
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6">
                                                    <fieldset class="form-group position-relative has-icon-left">
                                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="user-password" placeholder="Enter Password">
                                                        <div class="form-control-position">
                                                            <i class="ft-lock"></i>
                                                        </div>
                                                        @error('password')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <fieldset class="form-group position-relative has-icon-left">
                                                        <input type="password" name="password_confirmation" class="form-control" id="user-password" placeholder="Enter Confirm Password">
                                                        <div class="form-control-position">
                                                            <i class="ft-lock"></i>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="row" >
                                                <div class="col-md-6 col-lg-6">
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
                                                    <fieldset class="form-group position-relative has-icon-left">
                                                        <select name="grade" id="grade" class="form-control ">
                                                            <option value="" hidden>Select Grade</option>
                                                            <option value="3">3rd</option>
                                                            <option value="4">4th</option>
                                                            <option value="5">5th</option>
                                                            <option value="6">6th</option>
                                                            <option value="7">7th</option>
                                                            <option value="8">8th</option>
                                                            <option value="9">9th</option>
                                                            <option value="10">10th</option>
                                                            <option value="11">11th</option>
                                                            <option value="12">12th</option>
                                                        </select>
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
                                                <div class="col-md-12 col-lg-12">
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
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-danger btn-block btn-glow col-12 mr-1 mb-1" >Register</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="row form-link">
                                        <div class="col-xl-4 col-12">
                                            <p class="card-subtitle text-muted font-small-3 mx-2"><span>Goto <a href="{{ url('/') }}" class="card-link"> Home</a></span></p>
                                        </div>
                                        <div class="col-xl-8 col-12">
                                            <p class="card-subtitle text-muted text-right font-small-3 mx-2"><span>You already have an account ? <a href="{{ route('login') }}" class="card-link">Login</a></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    $('.datepicker').datepicker();

    @if(old('gender', null) !== null)
        $('#gender').val("{{ old('gender') }}")
    @endif

    @if(old('country', null) !== null)
        $('#country').val("{{ old('country') }}")
    @endif

    @if(old('timezone', null) !== null)
        $('#timezone').val("{{ old('timezone') }}")
    @endif

    @if(old('grade', null) !== null)
        $('#grade').val("{{ old('grade') }}")
    @endif
</script>
@endsection
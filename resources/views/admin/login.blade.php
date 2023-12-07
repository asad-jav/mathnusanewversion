@extends('layouts.auth')
@section('title', 'Admin - Login')
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper min-vh-100 my-2">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
            </div>
            <div class="content-body min-vh-100">
                <section class="flexbox-container min-vh-100">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-6 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                                <div class="card-header border-0">
                                    <div class="text-center mb-1">
                                        <img src="{{ asset('backend/app-assets/images/logo/logo.png')}}" class="w-100" alt="branding logo">
                                    </div>
                                    <div class="font-large-1  text-center">
                                        Admin Login
                                    </div>
                                </div>
                                <div class="card-content">

                                    <div class="card-body">
                                        <form class="form-horizontal" action="{{ url('admin/doLogin') }}" method="POST" novalidate>
                                            @csrf
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="text" name="email" class="form-control round @error('email') is-invalid @enderror @if(Session::has('status')) is-invalid @endif" id="user-name" placeholder="Your Username" value="{{ old('email') }}">
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                                @error('email')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                @if (Session::has('status'))
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ Session::get('status') }}</strong>
                                                    </span>
                                                @endif
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="password" name="password" class="form-control round @error('password') is-invalid @enderror" id="user-password" placeholder="Enter Password">
                                                <div class="form-control-position">
                                                    <i class="ft-lock"></i>
                                                </div>
                                                @error('password')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </fieldset>
                                            <div class="form-group row">
                                                <div class="col-md-6 col-12 text-center text-sm-left">

                                                </div>
                                                <div class="col-md-6 col-12 float-sm-left text-center text-sm-right"><a href="recover-password.html" class="card-link">Forgot Password?</a></div>
                                            </div>
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 mb-1">Login</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
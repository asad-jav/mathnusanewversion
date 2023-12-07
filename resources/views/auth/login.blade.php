@extends('layouts.auth')
@section('title', 'Student - Login')
@section('css')
    <style>
        @media screen and (max-width:767px) {
            /* .overflow {
                overflow:hidden;
                padding-top:15px;
            } */

            .img-auto-adjust{
                width: 100%;
            }
        }
    </style>
@endsection
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content py-1">
        <div class="content-wrapper min-vh-100">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
            </div>
            <div class="content-body min-vh-100">
                <section class="flexbox-container min-vh-100">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-lg-5 col-md-6 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                                <div class="card-header border-0">
                                    <div class="text-center mb-1">
                                        <img src="{{ asset('backend/app-assets/images/logo/logo.png')}}" class="img-auto-adjust " alt="branding logo">
                                    </div>
                                    <div class="font-large-1  text-center">
                                        Student Login
                                    </div>
                                </div>
                                <div class="card-content page">

                                    <div class="card-body pb-0">
                                        <form class="form-horizontal" action="{{ route('login') }}" method="POST" novalidate>
                                            @csrf
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="user-name" placeholder="Your Username" value="{{ old('email') }}">
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                                @error('email')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="user-password" placeholder="Enter Password" >
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
                                                <div class="col-md-12 col-12 float-sm-left text-center text-sm-right"><a href="{{ route('password.request') }}" class="card-link">Forgot Password?</a></div>
                                            </div>
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-danger btn-block btn-glow col-12 mr-1 mb-1">Login</button>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="row form-link">
                                        <div class="col-xl-4 col-12">
                                            <p class="card-subtitle text-muted font-small-3 mx-2"><span>Goto <a href="{{ url('/') }}" class="card-link"> Home</a></span></p>
                                        </div>
                                        <div class="col-xl-8 col-12">
                                            <p class="card-subtitle text-muted text-right font-small-3 mx-2"><span>If you don't have an account ? <a href="{{ route('register') }}" class="card-link">Register</a></span></p>
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
    <!-- END: Content-->
@endsection
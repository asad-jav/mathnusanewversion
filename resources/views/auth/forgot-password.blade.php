@extends('layouts.auth')
@section('title', 'Forget Password')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
        </div>
        <div class="content-body">
            
            <section class="flexbox-container">
                
                <div class="col-12 d-flex align-items-center justify-content-center">
                    
                    <div class="col-lg-4 col-md-6 col-10 box-shadow-2 pt-4">
                        
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                            <div class="card-header border-0">
                                {{-- <div class="text-center mb-1">
                                    <img src="{{ asset('public') }}/app-assets/images/logo/logo.png" class="img-auto-adjust" alt="branding logo">
                                </div> --}}
                                
                                <div class="font-large-1  text-center">
                                    Reset Password
                                </div>
                                <p class="pt-2 text-center">
                                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                                </p>
                            </div>
                            <div class="card-content page">

                                <div class="card-body pb-0">
                                    <form class="form-horizontal"  method="POST" action="{{ route('password.email') }}" novalidate>
                                        @csrf
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"  name="email" value="{{old('email')}}" required autofocus>
                                            <div class="form-control-position">
                                                <i class="ft-user"></i>
                                            </div>
                                            @error('email')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </fieldset>
                                       
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-danger btn-block btn-glow col-12 mr-1 mb-1">
                                                {{ __('Email Password Reset Link') }}
                                            </button>
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
@endsection

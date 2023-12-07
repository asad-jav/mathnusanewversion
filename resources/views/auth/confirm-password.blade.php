@extends('layouts.auth')
@section('title', 'Confirm Password')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
        </div>
        <div class="content-body">
            
            <section class="flexbox-container">
                
                <div class="col-12 d-flex align-items-center justify-content-center">
                    
                    <div class="col-lg-4 col-md-6 col-10 box-shadow-2 p-0">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                            <div class="card-header border-0"> 
                                <div class="font-large-1  text-center">
                                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                                </div>
                            </div>
                            <div class="card-content page">

                                <div class="card-body pb-0">
                                    <form method="POST" action="{{ route('password.confirm') }}">
                                        @csrf
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input  class="form-control @error('password') is-invalid @enderror" id="password"  type="password" name="password" required autocomplete="current-password">
                                            <div class="form-control-position">
                                                <i class="ft-user"></i>
                                            </div>
                                            @error('password')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </fieldset> 
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-danger btn-block btn-glow col-12 mr-1 mb-1">{{ __('Confirm') }}</button>
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

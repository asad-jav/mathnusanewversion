@extends('layouts.auth')
@section('title', 'School - Registration')
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
            <div class="min-vh-100">
                <section style="padding: 0 !important" class="flexbox-container min-vh-100 overflow">
                    <div style="padding: 0 !important" class="col-12 d-flex  justify-content-center">
                        <div class="col-lg-6 col-md-8 col-12 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 m-0" style="padding: 0px">
                                <section>
                                    @if (Session::has('success'))
                                        <div class="alert text-center bg-dark" style="align-items: center">
                                            <div style="font-size:20px">
                                                <i class="ft-check-circle"></i>
                                            </div>
                                            <div style="color:white">
                                                <h3 style="color:white">Thank You!</h3>
                                            </div>
                                            {{ Session::get('success') }}
                                        </div>
                                    @endif
                                    @if (Session::has('failure'))
                                        <div class="alert alert-danger text-center">
                                            {{ Session::get('failure') }}
                                        </div>
                                    @endif
                                </section>
                                <div class="card-header border-0">
                                    <div class="text-center mb-1">
                                        <img src="{{ asset('public') }}/app-assets/images/logo/logo.png" class="img-auto-adjust" alt="branding logo">
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body" style="padding-bottom: 0">
                                        <form class="form-horizontal" action="{{ route('schools.store') }}" method="POST" novalidate>
                                            @csrf
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <legend>School Info:</legend>
                                                <div class="row">
                                                    <div class="col-md-6 col-lg-6">
                                                        <fieldset class="form-group position-relative has-icon-left">
                                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="School Name*">
                                                            <div class="form-control-position">
                                                                <i class="ft-layout"></i>
                                                            </div>
                                                            @error('name')
                                                                <span class="text-danger" role="alert">
                                                                    {{ $message }}
                                                                </span>
                                                            @enderror
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6">
                                                        <fieldset class="form-group position-relative has-icon-left">
                                                            <input type="text" name="school_district" value="{{ old('school_district') }}" class="form-control @error('school_district') is-invalid @enderror" placeholder="School District*">
                                                            <div class="form-control-position">
                                                                <i class="ft-map"></i>
                                                            </div>
                                                            @error('school_district')
                                                                <span class="text-danger" role="alert">
                                                                    {{ $message }}
                                                                </span>
                                                            @enderror
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-lg-12">
                                                        <fieldset class="form-group position-relative has-icon-left">
                                                            <input type="text" name="school_address" value="{{ old('school_address') }}" class="form-control @error('school_address') is-invalid @enderror" placeholder="School Address*">
                                                            <div class="form-control-position">
                                                                <i class="ft-map-pin"></i>
                                                            </div>
                                                            @error('school_address')
                                                                <span class="text-danger" role="alert">
                                                                    {{ $message }}
                                                                </span>
                                                            @enderror
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <legend>Principal Info:</legend>
                                                <div class="row">
                                                    <div class="col-md-6 col-lg-6">
                                                        <fieldset class="form-group position-relative has-icon-left">
                                                            <input type="text" name="principal_name" value="{{ old('principal_name') }}" class="form-control @error('principal_name') is-invalid @enderror" placeholder="Principal Name*">
                                                            <div class="form-control-position">
                                                                <i class="ft-user"></i>
                                                            </div>
                                                            @error('principal_name')
                                                                <span class="text-danger" role="alert">
                                                                    {{ $message }}
                                                                </span>
                                                            @enderror
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6">
                                                        <fieldset class="form-group position-relative has-icon-left">
                                                            <input type="text" name="principal_email" value="{{ old('principal_email') }}" class="form-control @error('principal_email') is-invalid @enderror" placeholder="Principal Email*">
                                                            <div class="form-control-position">
                                                                <i class="ft-mail"></i>
                                                            </div>
                                                            @error('principal_email')
                                                                <span class="text-danger" role="alert">
                                                                    {{ $message }}
                                                                </span>
                                                            @enderror
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-lg-12">
                                                        <fieldset class="form-group position-relative has-icon-left">
                                                            <input type="text" name="principal_phone_no" value="{{ old('principal_phone_no') }}" class="form-control @error('principal_phone_no') is-invalid @enderror" placeholder="Principal Phone*">
                                                            <div class="form-control-position">
                                                                <i class="ft-phone"></i>
                                                            </div>
                                                            @error('principal_phone_no')
                                                                <span class="text-danger" role="alert">
                                                                    {{ $message }}
                                                                </span>
                                                            @enderror
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <legend>Math Lead Info:</legend>
                                                <div class="row">
                                                    <div class="col-md-6 col-lg-6">
                                                        <fieldset class="form-group position-relative has-icon-left">
                                                            <input type="text" name="team_lead_name" value="{{ old('team_lead_name') }}" class="form-control @error('team_lead_name') is-invalid @enderror" placeholder="Math Lead Name*">
                                                            <div class="form-control-position">
                                                                <i class="ft-user"></i>
                                                            </div>
                                                            @error('team_lead_name')
                                                                <span class="text-danger" role="alert">
                                                                    {{ $message }}
                                                                </span>
                                                            @enderror
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6">
                                                        <fieldset class="form-group position-relative has-icon-left">
                                                            <input type="text" name="team_lead_email" value="{{ old('team_lead_email') }}" class="form-control @error('team_lead_email') is-invalid @enderror" placeholder="Math Lead Email*">
                                                            <div class="form-control-position">
                                                                <i class="ft-mail"></i>
                                                            </div>
                                                            @error('team_lead_email')
                                                                <span class="text-danger" role="alert">
                                                                    {{ $message }}
                                                                </span>
                                                            @enderror
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-lg-12">
                                                        <fieldset class="form-group position-relative has-icon-left">
                                                            <input type="text" name="team_lead_phone_no" value="{{ old('team_lead_phone_no') }}" class="form-control @error('team_lead_phone_no') is-invalid @enderror" placeholder="Math Lead Phone*">
                                                            <div class="form-control-position">
                                                                <i class="ft-phone"></i>
                                                            </div>
                                                            @error('team_lead_phone_no')
                                                                <span class="text-danger" role="alert">
                                                                    {{ $message }}
                                                                </span>
                                                            @enderror
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-danger btn-block btn-glow col-12 mr-1 mb-1" >Submit</button>
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
@section('script')
    <script>
        $('div.alert').delay(3000).slideUp(300);
    </script>
@endsection
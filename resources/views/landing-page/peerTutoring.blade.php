@extends('layouts.landingPage')
@section('title', 'About us')

@section('css')
@endsection

@section('content')
<section class="our-services p-relative py-5 my-5 mt-5" style="background:url('{{ asset('public/app-assets/images/logo/logo-low-opacity-light.png') }}');background-repeat: no-repeat;background-attachment: fixed;background-position: center;">
    <div class="container pt-5 ">
        <div class="row py-4 mb-2">
            <div class="col-md-7 order-2">
                <div class="overflow-hidden mb-3">
                    <p class="text-color-dark font-weight-bold text-8 mb-2 pt-2 mt-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="">Peer-to-Peer Math Tutoring </p>
                </div>
                <p class="pb-3 appear-animation custom-text-4" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="">
                    Increase your kids’ motivation to learn mathematics with peer-to-peer tutoring.
                </p>
                
                <p class="pb-3 appear-animation custom-text-4" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="">
                    Peer tutoring inspires higher academic achievement and better interpersonal skills. Students are more motivated and engaged when they learn from each other in and outside the classroom. In our Just ask I.T. (Intelligent Tutors) program, we pair students with other top performers for structured learning sessions.
                    <br>
                </p>
               
                <p class="pb-3 appear-animation custom-text-4" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="">
                    You qualify for 2 days of free peer tutoring from one of our Just Ask I.T. tutors when you sign up for one of our lesson modules. 
                </p>
            </div>
            {{-- <div class="col-md-5 order-md-2 mb-4 mb-lg-0 appear-animation" data-appear-animation="fadeInRightShorter">
                <img src="{{ asset('public/landing-page/images/about-us/aboutus.jpg') }}" class="img-fluid mb-2" alt="">
            </div> --}}
        </div>
    </div>
</section>
@endsection

@section('script')
@endsection
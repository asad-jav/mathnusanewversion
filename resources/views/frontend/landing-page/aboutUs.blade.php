@extends('frontend.layouts.landingPage')
@section('title', 'About us')

@section('css')
@endsection

@section('content')
<section class="our-services p-relative py-5 my-5" style="background:url('{{ asset('backend/app-assets/images/logo/logo-low-opacity-light.png') }}');background-repeat: no-repeat;background-attachment: fixed;background-position: center;">
    <div class="container pt-5">
        <div class="row py-4 mb-2">
            <div class="col-md-7 order-2">
                
                
                <div class="overflow-hidden mb-3">
                    <p class="font-weight-bold text-primary text-uppercase mb-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="800">MATHNUSA Online Tutoring Advantages </p>
                </div>
                <p class="pb-3 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="800">
                    <ul class="pb-3 appear-animation custom-text-4" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="800">
                        <li>Live online tutoring that deepens students’ knowledge and understanding of various mathematical concepts</li>
                        <li>A learning environment that supports the benefits of traditional classroom tutoring sessions </li>
                        <li>Classes designed to increase peer collaboration and opportunities to work independently with a math teacher</li>
                        <li>Gamified teaching with an innovative gaming system.  Students who prefer to practice their math learn through a gamified platform that’s like today’s most popular video game.</li>
                        <li>Opportunities for students to learn how to use their weaknesses and strengths to gain a better understanding of math</li>
                        <li>Data-driven feedback that drives instruction in the classroom. It will improve teaching and learning experiences./li>
                    </ul>
                </p>
                <div class="overflow-hidden mb-3">
                    <p class="font-weight-bold text-primary text-uppercase mb-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="500">Choose the 6-Week Math Intensive</p>
                </div>
                <p class="pb-3 appear-animation custom-text-4" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="800">
                    Set your child on a journey to math success – without having to be an active part of the process. Pre-register for our 6-week summer eLearning Math Camp. During this camp, your child will do more than understand the complexities of math. They will become self-directed learners ready to tackle regular classes or standardized tests. <br>
                    [ <a href="#">Register Online</a> ]
                </p>
                <div class="overflow-hidden mb-3">
                    <p class="font-weight-bold text-primary text-uppercase mb-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="500">Building Problem Solvers for the Future </p>
                </div>
                <p class="pb-3 appear-animation custom-text-4" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="800">
                    From us, your child will learn the language of mathematics and how to understand the complexities of it. Once they learn to communicate efficiently, they learn to enjoy math and what it has to offer. But, that is not why they love it. They love it because they are engaged with their learning once again. 
                    
                    <p class="pb-3 appear-animation custom-text-4" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="800">There’s value in incorrect responses. To get lost in mathematics is to find the way! <br>
                    [ <a href="#">Register for a Class</a> ] [<a href="#">Try A Free Program</a>]
                    </p>
                </p>
            </div>
            <div class="col-md-5 order-md-2 mb-4 mb-lg-0 appear-animation" data-appear-animation="fadeInRightShorter">
                <img src="{{ asset('frontend/landing-page/images/about-us/aboutus.jpg') }}" class="img-fluid mb-2" alt="">
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
@endsection
@extends('layouts.landingPage')
@section('title', 'About us')

@section('css')
@endsection

@section('content')
<section class="our-services p-relative py-5 my-5" style="background:url('{{ asset('public/app-assets/images/logo/logo-low-opacity-light.png') }}');background-repeat: no-repeat;background-attachment: fixed;background-position: center;">
    <div class="container pt-5 ">
        <div class="row">
            <div class="col-lg-12 col-xl-12 d-flex flex-column justify-content-center align-items-start">
                <div class="overflow-hidden mb-3">
                    <div class="overflow-hidden">
                        <h2 class="text-color-dark font-weight-bold text-8 mb-0 pt-0 mt-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="300">Meet the MATHNUSA Team</h2>
                    </div>
                    <p class="appear-animation custom-text-4 " data-appear-animation="fadeInUpShorter" data-appear-animation-delay="700">
                        MATHNUSA is a team of passionate math instructors and tutors developing the problem solvers of the future. Together, they help students understand that while learning mathematics can be a challenge, it is also fun and engaging. 
                    </p>
                    <p class="appear-animation custom-text-4 " data-appear-animation="fadeInUpShorter" data-appear-animation-delay="700">
                        They know how to deliver actual online learning that eliminates the need for parent-tutoring, especially if parents aren’t comfortable teaching the subject to their kids. For our math instructors, math teaching is now more innovative to meet your kids where they are to engage them in active learning. 
                    </p>
                    <div class="overflow-hidden mb-3">
                        <p class="font-weight-bold text-primary text-uppercase mb-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="500">Our Founder </p>
                    </div>
                    <p class="appear-animation custom-text-4 " data-appear-animation="fadeInUpShorter" data-appear-animation-delay="700">
                        Mr. Kenneth L. Johnson is an international instructional Math Coach/Educator. He has won several national awards for math education in both the USA and Kuwait. He has also coached students to top awards and achievements in math.
                    </p>
                    <p class="appear-animation custom-text-4 " data-appear-animation="fadeInUpShorter" data-appear-animation-delay="700">
                        Throughout his career, Kenneth developed many classroom and online teacher improvements for enhanced student learning. These developments have led to better results for students and improved teacher capacity.
                    </p>
                    <p class="appear-animation custom-text-4 " data-appear-animation="fadeInUpShorter" data-appear-animation-delay="700">
                        MATHNUSA is a natural extension of his passion for teaching and seeing his students excel even as they grow to love the subject. <br> [ <a href="#newsletterEmail" id="joinUs" data-hash="" data-hash-offset="120">Join the MATHNUSA Team</a> ]
                    </p>
                    
                </div>
            </div>
            
        </div>
    </div>
</section>
@endsection

@section('script')
    <script>
        
    </script>
@endsection
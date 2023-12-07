@extends('layouts.landingPage')
@section('title', 'Course Topics')

@section('css')
<style>
    .page-header.page-header-modern.page-header-background {
    padding: 40px 0 200px;
    margin-bottom: 0;
    background-position: 0 100%;
    bottom:2px;
    }
    .cust-scrool{
        max-height: 100vh !important;
			overflow-y: auto;
			overflow-x: hidden;
		}
		.cust-scrool::-webkit-scrollbar {
			display: none;
		}
</style>
@endsection


@section('content')
<div role="main" class="main">

    <section class="page-header page-header-modern page-header-background bg-color-dark p-relative z-index-1" data-plugin-lazyload data-original="img/demos/digital-agency-2/bg/page-header-bg.jpg">
        <span class="custom-circle custom-circle-1 bg-color-light custom-circle-blur appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="400"></span>
        <span class="custom-circle custom-circle-2 bg-color-primary appear-animation" data-appear-animation="zoomIn" data-appear-animation-delay="500"></span>
        <span class="custom-circle custom-circle-3 bg-color-primary appear-animation" data-appear-animation="zoomIn" data-appear-animation-delay="600"></span>
        <div class="container">
            <div class="row mt-5">
                <div class="col">
                    <ul class="breadcrumb breadcrumb-light custom-title-with-icon-primary d-block">
                        <li><a href="{{ route('dashboard.all.courses', $course->grade) }}">Courses</a></li>
                        <li class="active">Topics</li>
                    </ul>
                    <h1 class="custom-text-10 font-weight-bolder mt-3">{{  $course->title }}</h1>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col">
                    <div class="tp-mask-wrap" style="position: absolute; display: block; overflow: visible;">
                        <form action="{{ route('payment') }}" method="POST">
                            @csrf
                            <input type="hidden" name="type" value="{{ App\Models\Plan::COURSE }}">
                            <input type="hidden" name="course_id" id="course_id" value="{{ $course->id }}">
                            <button type="submit" class="btn btn-outline custom-btn-outline btn-primary text-4 text-decoration-none font-weight-semibold text-color-light bg-color-hover-primary px-4 py-3 custom-btn-with-arrow">Join Our Session</button>
                        </form>
                    </div>                
                </div>
            </div>
           
        </div>

      
    </section>
    <section class="py-5">
        <div class="container sticky-container">
            <div class="row justify-content-between">
                <div class="col-sm-12 col-md-4 col-xl-2">
                    <div id="sidebar" class="side-menu-our-work sidebar mb-5">
                        <div>
                            <h4 class="text-color-dark custom-text-6 font-weight-bolder custom-title-with-icon custom-title-with-icon-primary">Grade {{ $course->grade->name }} Topics</h4>
                            <ul class="list-unstyled sort-source sort-source-light" data-sort-id="portfolio" data-option-key="filter">
                                <li class="nav-item active" data-option-value="*">
                                    <a href="#ourWork" data-hash data-hash-offset="100" class="text-color-quaternary text-color-hover-dark text-decoration-none mb-2 p-0 d-block font-weight-medium">View All</a>
                                </li>
                                @foreach ($course->topics as $topic)
                                    <li class="nav-item" data-option-value=".topic-{{ $topic->id }}">
                                        <a href="#ourWork" data-hash data-hash-offset="100" class="text-color-quaternary text-color-hover-dark text-decoration-none mb-2 p-0 d-block font-weight-medium">{{ $topic->topic_index }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-8 col-xl-9 our-work" id="ourWork">
                    <div class=" w-100 cust-scrool" data-sort-id="portfolio">
                        @foreach ($course->topics as $topic)
                        <div class="row w-100 mb-4 isotope-item topic-{{ $topic->id }} search-engine-optimize social-media-ads m-0">
                            <div class="col-sm-12 custom-our-work overlay overlay-op-9 overlay-show p-0">
                                <div class="text-left p-relative z-index-2 mb-3 h-100 pt-3 px-4">
                                    <h4 class="text-color-light text-5 font-weight-bolder mb-2">{{ $topic->title }}</h4>
                                    <div class="row text-color-quaternary ">
                                        <div class="col-sm-4 text-color-light">
                                            <p lass="text-color-light font-weight-semibold" style="color: #fff !important"><b>Unpack Standard</b></p>
                                        </div>
                                        <div class="col-sm-6 text-color-light">
                                            <p lass="text-color-light" style="color: #fff !important">{{ $topic->unpack_standard }}</p>
                                        </div>
                                    </div>
                                    <div class="row text-color-quaternary ">
                                        <div class="col-sm-4 text-color-light">
                                            <p lass="text-color-light font-weight-semibold" style="color: #fff !important"><b>Live Sessions</b></p>
                                        </div>
                                        <div class="col-sm-6 text-color-light">
                                            <p lass="text-color-light" style="color: #fff !important">{{ $topic->live_sessions }}</p>
                                        </div>
                                    </div>
                                    <p class="custom-text-3 text-color-quantinary text-decoration-none mb-3">
                                        {{ $topic->objectives }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="get-in-touch bg-color-after-secondary p-relative overflow-hidden">
        <span class="custom-circle custom-circle-1 bg-color-light appear-animation" data-appear-animation="zoomIn" data-appear-animation-delay="100"></span>
        <span class="custom-circle custom-circle-2 bg-color-light appear-animation" data-appear-animation="zoomIn" data-appear-animation-delay="100"></span>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <p class="mb-2 text-color-tertiary custom-text-7 custom-title-with-icon custom-title-with-icon-light appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="200">Let’s Get in Touch</p>
                    <h4 class="text-color-light font-weight-bolder custom-text-10 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="400">
                        We’re interested in talking<br/>
                        about your business.
                    </h4>
                </div>
                <div class="col-lg-4 d-flex align-items-center justify-content-start justify-content-lg-end mt-5 mt-lg-0">
                    <a herf="#" class="btn btn-outline custom-btn-outline btn-light border-white rounded-0 px-4 py-3 text-color-light text-color-hover-dark bg-color-hover-light custom-text-6 line-height-6 font-weight-semibold custom-btn-with-arrow appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="600">Let’s Talk!</a>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection

@section('script')

@endsection
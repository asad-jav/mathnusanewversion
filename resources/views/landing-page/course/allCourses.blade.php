@extends('layouts.landingPage')
@section('title', 'All Courses')

@section('css')
<link rel="stylesheet" href="{{ asset('public/landing-page') }}/css/demos/demo-hotel-allCourses.css">
<link rel="stylesheet" href="{{ asset('public/landing-page') }}/css/skins/skin-hotel-allCourses.css"> 
<style>
    .cus-btn-par-us button{
         border: 2px solid #e41645 !important;
         color: #fff;
    }
        html .bg-color-hover-primary:hover .cus-btn-par-us button{
          
            border: 2px solid #fff !important;
            color: #fff;
        }
        html .bg-hover-primary:hover .cus-btn-par-us button{
         
            border-color: 2px solid #fff !important;
            color: #fff;
        }
        .page-header.page-header-modern.page-header-background {
            padding: 40px 0 200px;
            margin-bottom: 0;
            background-position: 0 100%;
            bottom:2px;
            }
            /* .page-header.page-header-modern.page-header-background:after {
                content: '';
                display: block;
                width: 101%;
                height: 75px;
                left:-3px;
                bottom:-38px;
            } */
            .thumb-info-side-image-custom .thumb-info-caption h4 {
                margin: 12px 0 0 0;
            }
            .cour-cus-us{
                flex-direction: row;
                box-shadow: 0px 11px 15px -7px rgba(0, 0, 0, 0.2), 0px 24px 38px 3px rgba(0, 0, 0, 0.14), 0px 9px 46px 8px rgba(0, 0, 0, 0.12);
            }
            .cus-topic-priz{
                text-align: right;
            }.cus-curs-btn{
                position: absolute;
                bottom: 15px;
                right: 15px;
            }
            .cus-curs-txt{
                position: absolute;
                bottom: 8px;
                right: 15px;
            }
            .star-bg, .fa-star-half-alt, .far{
                color: #e41645;
                font-size: 11px;
            }  
            .txt-eclip{
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            .cus-topic-priz{
                padding-top: .5rem;
                }
                .cus-elicp-title{
                    display: -webkit-box;
                    max-width: 100%;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    min-height: 70px;
                }
                .card-grade-us {
                    top: 35px;
                    z-index: 9;
                    background: #eebb4d;
                   color: #fff;
                   padding: 10px 25px;
                   left: -18px;
                }
            @media only screen and (max-width: 991px) {
                .cus-topic-priz{
                text-align: left;
                padding-top: 0!important;
                }
                .cus-curs-btn{
                    position: relative;
                    bottom: 0px;
                    left: 0px;
                    float: left;
                    margin-bottom: 15px;
                }
                .cus-curs-txt{
                    position: relative;
                    bottom: 8px;
                    left: 0px;
                    float: left;
                    margin-bottom: 15px;
                    padding-left: 0;
                }
            }
            @media only screen and (min-width: 991px) {
               .cus-card-cours{
                   display: flex;
               }
            }
            @media only screen and (max-width: 991px) and (min-width:767px){
                .cus-card-cours{
                    max-width: 48%;
                    margin: 15px 5px!important;
                }
                .cus-curs-txt{
                    position: relative;
                    bottom: 0px;
                    left: 0px;
                    float: left;
                    margin-bottom: 15px;
                    padding-left: 0;
                }
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
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li class="active">Courses</li>
                    </ul>
                    <h1 class="custom-text-10 font-weight-bolder mt-3">All Subjects of Grade {{ $grade->name }}</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-no-background section-no-border m-0 pt-2 mb-3">
        <div class="container mt-5">
            <div class="row my-3 mb-3 appear-animation animated fadeInUpShorter appear-animation-visible"data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200" style="animation-delay: 200ms;">
            @foreach ($courses as $course)
                <div class="col-sm-12 col-md-6 col-lg-12 cour-cus-us p-0 cus-card-cours mt-4 overflow-hidden">
                    <span class="card-grade-us text-right" style="width: 100px">{{ $grade->name }}</span>
                    <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3 p-0">
                        <span class="thumb-info-side-image-wrapper">
                            <img alt="" class="img-fluid w-100 h-100"  src="{{ asset('public/courses_images/'.$course->image) }}">
                        </span>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-7 pt-2">
                        <a href="{{ route('dashboard.course.sections', $course->id) }}">
                            <h4 class="text-uppercase mb-1 txt-eclip">{{$course->title}}</h4>
                            </a>
                            <p class="mb-2"><strong>{{ $course->user->first_name.' '.$course->user->last_name }}</strong></p>
                            <p class="mb-1 cus-elicp-title">{{$course->course_outline}}</p>
                            <h5 class="mb-1"><strong class="pr-2">2.5</strong>
                                <i class="fas fa-star star-bg"></i>
                                <i class="fas fa-star star-bg"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <small class="px-1">(123,45)</small>
                            </h5>
                        <ul class="row px-3 mb-2">
                            {{-- <li style="list-style:none; padding-right:25px">33.5 total hours</li> --}}
                            <li style="list-style:none; padding-right:25px">{{ $course->topics->count() }} Topics</li>
                        </ul>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-2 pt-2 cus-topic-priz">
                        <p class="mb-1"><strong>{{ App\User::countrySpecificAmount($course) }} {{ App\User::countrySpecificSymbol() }} </strong></p>
                        <p class="pt-2 cus-curs-btn m-0" style="">
                            @if (Auth::check())
                                @if (Auth::user()->courses->contains($course->id))
                                    <h4 class=" cus-curs-txt btn-lg text-success mb-0 pr-0 pb-0">Purchased</h4>
                                @else
                                    <a href="{{ route('dashboard.course.sections', $course->id) }}" class="btn btn-primary cus-curs-btn btn-lg text-2 text-uppercase">Buy</a>
                                @endif
                            @else
                                <a href="{{ route('dashboard.course.sections', $course->id) }}" class="btn btn-primary cus-curs-btn btn-lg text-2 text-uppercase">Buy</a>
                            @endif
                           
                            
                            {{-- @if (Auth::check())
                                @if (Auth::user()->courses->contains($course->id))
                                    <h4 class=" cus-curs-txt btn-lg text-success mb-0 pr-0 pb-0">Purchased</h4>
                                @else
                                    <form action="{{ route('payment') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="type" value="{{ App\Plan::COURSE }}">
                                        <input type="hidden" name="course_id" id="course_id" value="{{ $course->id }}">
                                        <button type="submit" class="btn btn-primary cus-curs-btn btn-lg text-2 text-uppercase">Buy</button>
                                    </form>
                                @endif
                            @else
                                <form action="{{ route('payment') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="type" value="{{ App\Plan::COURSE }}">
                                    <input type="hidden" name="course_id" id="course_id" value="{{ $course->id }}">
                                    <button type="submit" class="btn btn-primary cus-curs-btn btn-lg text-2 text-uppercase">Buy</button>
                                </form>
                            @endif --}}
                        </p>
                    </div>
                </div>     						
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
@endsection
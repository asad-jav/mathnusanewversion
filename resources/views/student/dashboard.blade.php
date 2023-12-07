@extends('layouts.admin')
@section('title', 'Student - Dashboard')

@section('css')
<link rel="stylesheet" href="{{ asset('backend/app-assets/css/pages/advanced-cards.css')}}"> 
<link rel="stylesheet" href="{{ asset('backend/app-assets/fonts/simple-line-icons/style.min.css')}}"> 
<style>
    .card-footer .btn:hover {
    color: #2b345f;
    text-decoration: none;
}
.card .card{
    box-shadow: 0px 0px 2px 0px rgba(62, 57, 10)!important;
}
.cus-order li{
    list-style-type: initial !important;
}
#DataTables_Table_0_wrapper > .row > .col-sm-12.col-md-6{
    align-self: flex-end;
}
@media (max-width: 991.98px){
    .dataTables_wrapper .table {
        display: table;
        }
}
</style>
@endsection

@section('content')
    <!-- BEGIN: Content-->
    {{-- <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div id="user-profile">
                    <div class="row">
                        <div class="col-sm-12 col-xl-8">
                            <div class="media d-flex m-1 ">
                                <div class="align-left p-1">
                                    <a href="#" class="profile-image">
                                        <img src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-1.png')}}" class="rounded-circle img-border height-100" alt="Card image">
                                    </a>
                                </div>
                                <div class="media-body text-left  mt-1">
                                    <h3 class="font-large-1 white">{{ Auth::user()->first_name }}
                                        <span class="font-medium-1 white">(Student)</span>
                                    </h3>
                                    <p class="white">
                                        <i class="ft-map-pin white"> </i> New York, USA </p>
                                    <p class="white text-bold-300 d-none d-sm-block">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed odio risus. Integer sit amet dolor elit. Suspendisse
                                        ac neque in lacus venenatis convallis. Sed eu lacus odio</p>
                                    <ul class="list-inline">
                                        <li class="pr-1 line-height-1">
                                            <a href="#" class="font-medium-4 white ">
                                                <span class="ft-facebook"></span>
                                            </a>
                                        </li>
                                        <li class="pr-1 line-height-1">
                                            <a href="#" class="font-medium-4 white ">
                                                <span class="ft-twitter white"></span>
                                            </a>
                                        </li>
                                        <li class="line-height-1">
                                            <a href="#" class="font-medium-4 white ">
                                                <span class="ft-instagram"></span>
                                            </a>
                                        </li>
                                    </ul>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-lg-5 col-md-12">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <div class="card-title-wrap bar-primary">
                                        <div class="card-title">Work History</div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body p-0 pt-0 pb-1">
                                        <ul>
                                            <li>
                                                <strong>99%</strong>
                                                Job Success
                                            </li>
                                            <li>
                                                <strong>4.9 stars </strong>
                                                <i class="la la-star yellow darken-2"></i>
                                                <i class="la la-star yellow darken-2"></i>
                                                <i class="la la-star yellow darken-2"></i>
                                                <i class="la la-star yellow darken-2"></i>
                                                <i class="la la-star yellow darken-2"></i>
                                            <li>
                                                <strong>1022</strong> Hours Worked</li>
                                            <li>
                                                <strong>26</strong> Jobs</li>

                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <div class="card">
                                <div class="card-header pb-0">
                                    <div class="card-title-wrap bar-primary">
                                        <div class="card-title">Other Details</div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body p-0 pt-0 pb-1">
                                        <ul>
                                            <li>
                                                <strong>Availability: </strong>
                                                10-30 hrs / week
                                            </li>
                                            <li>
                                                <strong>24 hours </strong> response time

                                            <li>
                                                <strong>Languages: </strong> English/ Spanish</li>


                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Project X</h4>
                                    <div class="heading-elements">
                                        <ul class="list-inline d-block mb-0">
                                            <li>
                                                <i class="ft-bar-chart font-large-1 danger"></i>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body pt-0 pb-1">
                                        <h6 class="text-bold-600"> Task done:
                                            <span>4/10</span>
                                        </h6>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="media d-flex">
                                            <div class="align-self-center">
                                                <h6 class="text-bold-600 mt-2"> Client:
                                                    <span class="info">Xeon Inc.</span>
                                                </h6>
                                                <h6 class="text-bold-600 mt-1"> Deadline:
                                                    <span class="blue-grey">June, 2018</span>
                                                </h6>
                                            </div>
                                            <div class="media-body text-right mt-2">
                                                <ul class="list-unstyled users-list">
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="John Doe" class="avatar avatar-sm pull-up">
                                                        <img class="media-object rounded-circle" src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-19.png')}}" alt="Avatar">
                                                    </li>
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Katherine Nichols" class="avatar avatar-sm pull-up">
                                                        <img class="media-object rounded-circle" src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-18.png')}}" alt="Avatar">
                                                    </li>
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Joseph Weaver" class="avatar avatar-sm pull-up">
                                                        <img class="media-object rounded-circle" src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-17.png')}}" alt="Avatar">
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-7 col-md-12">
                            <!--Project Timeline div starts-->
                            <div id="timeline">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title-wrap bar-primary">
                                            <div class="card-title">Project Timeline</div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-block">
                                            <div class="timeline">
                                                <h4>Project ABC</h4>
                                                <hr>
                                                <ul class="list-unstyled base-timeline activity-timeline mt-3">

                                                    <li>
                                                        <div class="timeline-icon bg-primary">
                                                            <i class="ft-monitor font-medium-1"></i>
                                                        </div>
                                                        <div class="act-time">Feb, 2018</div>
                                                        <div class="base-timeline-info">
                                                            <a href="#" class="text-primary text-uppercase line-height-2">Development</a>
                                                            <span class="d-block">Functionality development for dashboard, login page and user profile page are in-progress. </span>
                                                        </div>
                                                        <small class="text-muted">
                                                            15 days ago
                                                        </small>
                                                        <ul class="base-timeline-sub list-unstyled users-list m-0">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="John Doe" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-14.png')}}" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Katherine Nichols" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-13.png')}}" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Joseph Weaver" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-12.png')}}" alt="Avatar">
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="timeline-icon bg-info">
                                                            <i class="ft-feather font-medium-1"></i>
                                                        </div>
                                                        <div class="act-time">Sep, 2017</div>
                                                        <div class="base-timeline-info">
                                                            <a href="#" class="text-info text-uppercase  line-height-2">Design</a>
                                                            <span class="d-block">Design for dashboard, login page and user profile page completed.</span>
                                                        </div>
                                                        <small class="text-muted">
                                                            15 days ago
                                                        </small>
                                                        <ul class="base-timeline-sub list-unstyled users-list m-0">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="John Doe" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-16.png')}}" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Katherine Nichols" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-15.png')}}" alt="Avatar">
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>

                                                <br>

                                                <h4>Project X</h4>
                                                <hr>
                                                <ul class="list-unstyled base-timeline activity-timeline mt-3">
                                                    <li>
                                                        <div class="timeline-icon bg-danger">
                                                            <i class="ft-users font-medium-1"></i>
                                                        </div>
                                                        <div class="act-time">July, 2019</div>
                                                        <div class="base-timeline-info">
                                                            <a href="#" class="text-danger text-uppercase  line-height-2">Implementation</a>
                                                            <span class="d-block">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed odio risus.</span>
                                                        </div>
                                                        <small class="text-muted">
                                                            15 days ago
                                                        </small>
                                                        <ul class="base-timeline-sub list-unstyled users-list m-0">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="John Doe" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-13.png')}}" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Katherine Nichols" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-17.png')}}" alt="Avatar">
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="timeline-icon bg-primary">
                                                            <i class="ft-monitor font-medium-1"></i>
                                                        </div>
                                                        <div class="act-time">Feb, 2018</div>
                                                        <div class="base-timeline-info">
                                                            <a href="#" class="text-primary text-uppercase line-height-2">Development</a>
                                                            <span class="d-block">Integer sit amet dolor elit. Suspendisse ac neque in lacus venenatis convallis. Sed eu lacus odio</span>
                                                        </div>
                                                        <small class="text-muted">
                                                            15 days ago
                                                        </small>
                                                        <ul class="base-timeline-sub list-unstyled users-list m-0">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="John Doe" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-14.png')}}" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Katherine Nichols" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-13.png')}}" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Joseph Weaver" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-12.png')}}" alt="Avatar">
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                                <br>
                                                <h4>Project Y</h4>
                                                <hr>
                                                <ul class="list-unstyled base-timeline activity-timeline mt-3">
                                                    <li>
                                                        <div class="timeline-icon bg-danger">
                                                            <i class="ft-users font-medium-1"></i>
                                                        </div>
                                                        <div class="act-time">July, 2019</div>
                                                        <div class="base-timeline-info">
                                                            <a href="#" class="text-danger text-uppercase line-height-2">Implementation</a>
                                                            <span class="d-block">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed odio risus.</span>
                                                        </div>
                                                        <small class="text-muted">
                                                            15 days ago
                                                        </small>
                                                        <ul class="base-timeline-sub list-unstyled users-list m-0">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="John Doe" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-13.png')}}" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Katherine Nichols" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-17.png')}}" alt="Avatar">
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="timeline-icon bg-primary">
                                                            <i class="ft-monitor font-medium-1"></i>
                                                        </div>
                                                        <div class="act-time">Feb, 2018</div>
                                                        <div class="base-timeline-info">
                                                            <a href="#" class="text-primary text-uppercase line-height-2">Development</a>
                                                            <span class="d-block">Integer sit amet dolor elit. Suspendisse ac neque in lacus venenatis convallis. Sed eu lacus odio</span>
                                                        </div>
                                                        <small class="text-muted">
                                                            15 days ago
                                                        </small>
                                                        <ul class="base-timeline-sub list-unstyled users-list m-0">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="John Doe" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-14.png')}}" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Katherine Nichols" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-13.png')}}" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Joseph Weaver" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-12.png')}}" alt="Avatar">
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="timeline-icon bg-info">
                                                            <i class="ft-feather font-medium-1"></i>
                                                        </div>
                                                        <div class="act-time">Sep, 2017</div>
                                                        <div class="base-timeline-info">
                                                            <a href="#" class="text-info text-uppercase line-height-2">Design</a>
                                                            <span class="d-block">Suspendisse ac neque in lacus venenatis convallis. Sed eu lacus odio</span>
                                                        </div>
                                                        <small class="text-muted">
                                                            15 days ago
                                                        </small>
                                                        <ul class="base-timeline-sub list-unstyled users-list m-0">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="John Doe" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-16.png')}}" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Katherine Nichols" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-15.png')}}" alt="Avatar">
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="timeline-icon bg-warning">
                                                            <i class="ft-activity font-medium-1 "></i>
                                                        </div>
                                                        <div class="act-time ">Dec, 2016</div>
                                                        <div class="base-timeline-info">
                                                            <a href="#" class="text-warning text-uppercase line-height-2">Analysis</a>
                                                            <span class="d-block">Integer sit amet venenatis convallis. Sed eu lacus odio</span>
                                                        </div>
                                                        <small class="text-muted">
                                                            15 days ago
                                                        </small>
                                                        <ul class="base-timeline-sub list-unstyled users-list m-0">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="John Doe" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-19.png')}}" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Katherine Nichols" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-18.png')}}" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Joseph Weaver" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-17.png')}}" alt="Avatar">
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Project Timeline div ends-->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div> --}}
    <!-- END: Content-->
    
     <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            {{-- <div class="content-header row"></div> --}}
            <div class="content-body">
                 <!-- Revenue, Hit Rate & Deals -->
                 @if (Session::has('failure'))
                 <div class="alert alert-danger">
                     <b>Oops! </b> {{ Session::get('failure') }}
                 </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-danger">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <section id="video-gallery" class="card">
                    <div class="card-header">
                        <h4 class="card-title">Lectures info</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <div class="card bg-gradient-x-purple-blue">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="media d-flex">
                                                    <div class="align-self-top">
                                                        <i class="icon-eye icon-opacity text-white font-large-4 float-left"></i>
                                                    </div>
                                                    <div class="media-body text-white text-right align-self-bottom mt-3">
                                                        <span class="d-block mb-1 font-medium-1">Total Lecture</span>
                                                        <h1 class="text-white mb-0">{{$total_lectures}}</h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-xl-4 col-lg-6 col-12">
                                    <div class="card bg-gradient-x-purple-red">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="media d-flex">
                                                    <div class="align-self-top">
                                                        <i class="icon-users icon-opacity text-white font-large-4 float-left"></i>
                                                    </div>
                                                    <div class="media-body text-white text-right align-self-bottom mt-3">
                                                        <span class="d-block mb-1 font-medium-1">Missed Lectures </span>
                                                        <h1 class="text-white mb-0">{{$missed_lectures}}</h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <div class="card bg-gradient-x-blue-green">
                                        {{-- <a href="#"> --}}
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="media d-flex">
                                                    <div class="align-self-top">
                                                        <i class="icon-tag icon-opacity text-white font-large-4 float-left"></i>
                                                    </div>
                                                    <div class="media-body text-white text-right align-self-bottom mt-3">
                                                        <span class="d-block mb-1 font-medium-1">Attended Lectures</span>
                                                        <h1 class="text-white mb-0">{{$attended_lectures->count()}}</h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- </a> --}}
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </section>
                <section id="video-gallery" class="card">
                    <div class="card-header">
                        <h4 class="card-title">Video gallery</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <h5 class="card-header">Latest Videos</h5>
                            <div class="row">
                                @foreach ($videos as $video)
                                    <div class="col-lg-4 col-xs-12 mb-2">
                                        <div class="embed-responsive embed-responsive-item embed-responsive-16by9">
                                            <iframe class="img-thumbnail" src="https://www.youtube.com/embed/{{ $video->link }}?rel=1&amp;controls=1&amp;showinfo=0" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            
                        </div>
                    </div>
                </section>
                
                <section id="video-gallery" class="card">
                    <div class="card-header">
                        <h4 class="card-title">Courses registered</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                @foreach($enrolled_courses as $enrolled_course)
                                    <div class="col-md-4 col-sm-6">
                                        <div class="card-deck">
                                            <div class="card" >
                                                <img class="card-img-top img-fluid" src="{{asset('courses_images/'.$enrolled_course->image)}}" alt="Card image cap">
                                                <div class="card-body">
                                                    <h4 class="card-title"> 
                                                        {{$enrolled_course->title}}
                                                        ({{App\Models\Section::find($enrolled_course->pivot->section_id)->name ?? ''}})
                                                    </h4>
                                                    <p class="card-text">{{$enrolled_course->course_outline}}</p>
                                                    <p class="card-text">
                                                        <small class="text-muted">{{App\Models\User::getCurrentDateDifference($enrolled_course->pivot->created_at)}}</small>
                                                    </p>
                                                    <div class="text-left">
                                                        <a href="{{ route('student.course.lecture', ['course_id'=>$enrolled_course->id, 'section_id'=>$enrolled_course->pivot->section_id]) }}" class="btn btn-primary">View Lectures</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
                
                {{-- <section id="card-headings">
                    <div class="row">
                        <div class="col-12 mt-3 mb-1">
                            <h4 class="text-uppercase">Up-coming lectures</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header" id="heading-links">
                                    <h4 class="card-title">Today lectures</h4>
                                    <a class="heading-elements-toggle">
                                        <i class="la la-ellipsis-v font-medium-3"></i>
                                    </a>
                                </div>
                                <div class="card-body">
                                    
                                    <ol class="cus-order">
                                        <a href="#">
                                        <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
                                        </a>
                                        <a href="#">
                                        <li>Aliquam tincidunt mauris eu risus.</li>
                                        </a>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="heading-multiple-thumbnails">Tomorrow lectures</h4>
                                    <a class="heading-elements-toggle">
                                        <i class="la la-ellipsis-v font-medium-3"></i>
                                    </a>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <ol class="cus-order">
                                            <a href="#">
                                            <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
                                            </a>
                                            <a href="#">
                                            <li> <i class="fas fa-circle"></i>Aliquam tincidunt mauris eu risus.</li>
                                            </a>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section> --}}
            </div>
        </div>
    </div> 
@endsection

@section('script')
   <script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/datatables.min.js')}}" type="text/javascript"></script>
   <script src="{{ asset('backend/app-assets/js/scripts/tables/datatables/datatable-styling.js')}}" type="text/javascript"></script>
@endsection
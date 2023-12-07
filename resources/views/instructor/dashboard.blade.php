@extends('layouts.admin')
@section('title', 'Instructor - Dashboard')

@section('css')
<link rel="stylesheet" href="{{ asset('backend/app-assets/css/pages/advanced-cards.css') }}">
<link rel="stylesheet" href="{{ asset('backend/app-assets/fonts/simple-line-icons/style.min.css') }}">
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
     <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            {{-- <div class="content-header row"></div> --}}
            <div class="content-body">
                 <!-- Revenue, Hit Rate & Deals -->
                 @if (Session::has('failure'))
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
                                                        <span class="d-block mb-1 font-medium-1">Delivered Lectures</span>
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
                                @foreach($enrolled_sections as $enrolled_section)

                                    <div class="col-md-4 col-sm-6">
                                        <div class="card-deck">
                                            <div class="card" >
                                                <img class="card-img-top img-fluid" src="{{asset('courses_images/'.$enrolled_section->course->image)}}" alt="Card image cap">
                                                <div class="card-body">
                                                    <h4 class="card-title">
                                                        {{$enrolled_section->course->title}} ({{ $enrolled_section->name }})

                                                    </h4>
                                                    <p class="card-text">{{$enrolled_section->course->course_outline}}</p>
                                                    <p class="card-text">
                                                        <small class="text-muted">{{App\Models\User::getCurrentDateDifference($enrolled_section->pivot->created_at)}}</small>
                                                    </p>
                                                    <div class="text-left">
                                                        <a href="{{ route('instructor.course.lectures', ['course_id'=>$enrolled_section->course->id, 'section_id'=>$enrolled_section->id]) }}" class="btn btn-primary">View Lectures</a>

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
   <script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/datatables.min.js') }}" type="text/javascript"></script>
   <script src="{{ asset('backend/app-assets/js/scripts/tables/datatables/datatable-styling.js') }}" type="text/javascript"></script>
@endsection

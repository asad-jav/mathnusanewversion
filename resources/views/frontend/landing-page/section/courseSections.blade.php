@extends('frontend.layouts.landingPage')
@section('title', 'All Courses')

@section('css')
<link rel="stylesheet" href="{{ asset('frontend/landing-pag/css/demos/demo-hotel-allCourses.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/landing-pag/css/skins/skin-hotel-allCourses.css')}}">
<style>
    .page-header.page-header-modern.page-header-background {
        padding: 40px 0 200px;
        margin-bottom: 0;
        background-position: 0 100%;
        bottom: 2px;
    }

    .cust-scrool {
        max-height: 100vh !important;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .cust-scrool::-webkit-scrollbar {
        display: none;
    }
</style>
<style>
    .rating-container {
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        background-color: #f9f9f9;
    }

    .user-info {
        display: flex;
        align-items: center;
    }

    .user-image {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .img-box {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #f9f9f9;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 18px;
        margin-right: 10px;
    }

    .user-details {
        flex-grow: 1;
    }

    .rating {
        color: #333;
        margin-bottom: 5px;
    }

    .bi-star, .bi-star-fill {
        font-size: 20px;
    }

    .comment {
        font-style: italic;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                        <li class="active">sections</li>
                    </ul>
                    <h1 class="custom-text-10 font-weight-bolder mt-3">{{$course->title}} ({{$course->grade->name}})</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-no-background section-no-border m-0">
        <div class="container">
            @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <strong>Well Done!</strong> {{Session::get('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if (Session::has('failure'))
            <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                <strong>Sorry!</strong> {{Session::get('failure')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="row mt-2">
                @if ($course->sections()->exists())
                <div class="col-lg-3">
                    <div class="tabs tabs-vertical tabs-left tabs-navigation">
                        <ul class="nav nav-tabs col-sm-3">
                            @foreach ($course->sections as $section)
                            <li class="nav-item @if($loop->first) active @endif">
                                <a class="nav-link" href="#tab_{{$section->id}}" data-toggle="tab">
                                    {{$section->name}}
                                    <span class="float-right mr-3">{{$section->enrollment_count}} / {{$section->max_enrollment}}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    @foreach ($course->sections as $section)
                    <div class="tab-pane tab-pane-navigation @if($loop->first) active @endif appear-animation animated fadeInRightShorter appear-animation-visible" id="tab_{{$section->id}}" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="200" style="animation-delay: 200ms;">
                        @if (!$section->lectures->isEmpty())
                        <div class="row">
                            <div class="col-12">
                                @if (Auth::check() && Auth::user()->isEnrolled($section->course->id, $section->id))
                                <h4 class="cus-curs-txt btn-lg text-success mb-0 pr-0 pb-0 float-right">Purchased</h4>
                                @else
                                <form action="{{ route('payment') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="type" value="{{ App\Models\Plan::COURSE }}">
                                    <input type="hidden" name="course_id" id="course_id" value="{{ $section->course->id }}">
                                    <input type="hidden" name="section_id" id="section_id" value="{{$section->id}}">
                                    <button type="submit" class="btn btn-primary cus-curs-btn text-4 text-uppercase float-right">
                                        Join in
                                        {{App\Models\User::countrySpecificAmount($section->course)}}
                                        {{App\Models\User::countrySpecificSymbol()}}
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            @if ($section->lectures->isEmpty())
                            <div class="col-12">No lectures found</div>
                            @else
                            @foreach ($section->lectures as $lecture)
                            <div class="col-lg-12">
                                <div class=" row py-3">
                                    <div class="col-6">
                                        <h3 class="mb-2 pb-0 text-uppercase title-ecpilc">{{$lecture->title}} </h3>
                                    </div>
                                    {{-- <div class="col-6">
                                                        @if (Auth::check() && Auth::user()->isEnrolled($section->course->id, $section->id))
                                                            <a href="{{url('class/lecture/'.$lecture->id)}}" class=" btn btn-primary cus-curs-btn btn-lg text-2 text-uppercase float-right">Join Lecture</a>
                                    @endif
                                </div> --}}
                            </div>
                            <table class="table table-sm">
                                <tr>
                                    <th>Topic:</th>
                                    <td>{{$lecture->topic->title}}</td>
                                </tr>
                                <tr>
                                    <th>Date:</th>
                                    <td>{{$lecture->datetime}}</td>
                                </tr>
                                <tr>
                                    <th>Start Time:</th>
                                    <td>
                                        @if (Auth::check())
                                        {{ Carbon\Carbon::parse($lecture->datetime.' '.$lecture->start_time)->setTimezone(Auth::user()->timezone) }}
                                        @else
                                        {{ Carbon\Carbon::parse($lecture->datetime.' '.$lecture->start_time)->setTimezone('UTC') }}
                                        @endif

                                    </td>
                                </tr>
                                <tr>
                                    <th>Duration:</th>
                                    <td>{{$lecture->duration}}h</td>
                                </tr>
                                <tr>
                                    <th>Average Rating:</th>
                                    <td>
                                    {{ $course->ratings->avg('rating') }}/5
                                    </td>
                                </tr>
                            </table>
                            <p class="mt-4">{{$lecture->outline}}</p>
                            @if (!$loop->last)
                            <hr style="wbackground:#e41645">
                            @endif
                        </div>
                        @endforeach
                        @endif
                        <div class="col-12">
                            
                            @foreach ($ratings as $rating)
                            <div class="rating-container">
                                <div class="user-info">
                                    @if (!Auth::user())
                                    <img src="{{ asset('profile_images/dummy-image.jpg') }}" alt="User Image" class="user-image">
                                    @else
                                    <div class="img-box">
                                        {{ Auth::user()->first_name[0] . Auth::user()->last_name[0] }}
                                    </div>
                                    @endif
                                    <div class="user-details">
                                        <strong>{{ $rating->user->first_name ?? 'Unknown' }} {{ $rating->user->last_name ?? '' }}</strong>
                                        <div class="rating">
                                            @for ($i = 1; $i <= 5; $i++) @if ($i <=$rating->rating)
                                                <i class="bi bi-star-fill text-warning"></i>
                                                @else
                                                <i class="bi bi-star text-warning"></i>
                                                @endif
                                                @endfor
                                        </div>
                                        @if($rating->comment)
                                        <div class="comment">
                                            <span>Comment: {{ $rating->comment }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach


                            @if(Auth::user())
                            <!-- Star rating form -->
                            <form id="ratingForm" action="{{ route('rate.course', $course->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <div id="ratingContainer"></div>
                                </div>
                                <div class="form-group">
                                    <textarea name="comment" class="form-control" placeholder="Leave a comment"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit Rating</button>
                                </div>
                            </form>
                            @endif
                        </div>

                    </div>
                </div>
                @endforeach

            </div>
            @else
            <p class="lead">No sections available yet. Stay tuned</p>
            @endif
        </div>
</div>
</section>

</div>
@endsection

@section('script')
<!-- Add this in the head section of your HTML -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/rateyo@2.3.2/min/jquery.rateyo.min.css" />

<!-- Add this at the end of your body section, before your other scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

<script>
    $(function() {
        // Initialize RateYo with options
        $("#ratingContainer").rateYo({
            rating: 0,
            starWidth: "25px",
        });

        // Handle the form submission
        $("#ratingForm").submit(function(event) {
            event.preventDefault();

            var rating = $("#ratingContainer").rateYo("rating");
            var comment = $("textarea[name='comment']").val();

            // Send the rating and comment to the server using AJAX
            $.ajax({
                url: "{{ route('rate.course', $course->id) }}",
                method: "POST",
                data: {
                    rating: rating,
                    comment: comment,
                    _token: "{{csrf_token()}}"
                }, // Include CSRF token
                success: function(data) {
                    // Reload the page after successful submission
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle the error event if needed
                    console.error('Error submitting rating:', error);
                }
            });
        });
    });
</script>
@endsection
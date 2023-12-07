@extends('layouts.admin')
@section('title', 'Dashboard')

@section('css')
@endsection

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Revenue, Hit Rate & Deals -->
            @if (Session::has('failure'))
            <div class="alert alert-danger">
                {{ Session::get('failure') }}
            </div>
            @endif
            @if (Session::has('success'))
            <div class="alert alert-danger">
                {{ Session::get('success') }}
            </div>
            @endif
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header p-1">
                                <h4 class="card-title float-left">Quick Information</h4>
                                {{-- <span class="badge badge-pill badge-info float-right m-0">Approved</span> --}}
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-footer text-center p-">
                                    <div class="row">
                                        <div class="col-md-4 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                            <p class="blue-grey lighten-2 mb-0">Instructors</p>
                                            <p class="font-medium-5 text-bold-400">{{$instructors?->count() ?? 0}}</p>

                                        </div>
                                        <div class="col-md-4 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                            <p class="blue-grey lighten-2 mb-0">Students</p>
                                            <p class="font-medium-5 text-bold-400">{{$students?->count() ?? 0}}</p>

                                        </div>
                                        <div class="col-md-4 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                            <p class="blue-grey lighten-2 mb-0">Courses</p>
                                            <p class="font-medium-5 text-bold-400">{{$courses?->count() ?? 0}}</p>

                                        </div>
                                    </div>
                                    <hr>
                                    <span class="text-muted"><a href="#" class="danger darken-2">MATHNUSA</a> Statistics</span>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row match-height">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <h5 class="card-title text-bold-700 my-2">Instructor Courses</h5>
                    <div class="card">
                        <div class="card-content">
                            <div id="recent-projects" class="media-list position-relative">
                                <div class="table-responsive">
                                    <table class="table table-padded table-xl mb-0" id="recent-project-table">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Project Name</th>
                                                <th class="border-top-0">Assigned to</th>
                                                <th class="border-top-0">Tenure</th>
                                                <th class="border-top-0">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($courses as $course)
                                                <tr>
                                                    <td class="text-truncate align-middle">
                                                        <a href="{{ url('course/lectures/'.$course->id) }}" title="See Lectures">{{ $course->title }}</a>
                                                    </td>
                                                    <td class="text-truncate">
                                                        <ul class="list-unstyled users-list m-0">
                                                            @foreach($course->users as $user)
                                                                @if($user->isInstructor())    
                                                                <li data-toggle="tooltip" data-popup="tooltip-custom"
                                                                    data-original-title="{{$user->first_name}} {{$user->last_name}}"
                                                                    class="avatar avatar-sm pull-up">
                                                                    <img class="media-object rounded-circle"
                                                                        src="{{ asset('public') }}/profile_images/{{$user->avatar2}}"
                                                                        alt="Avatar">
                                                                </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td class="text-truncate pb-0">
                                                        <span>
                                                            {{date("d M, Y",strtotime($course->start_date))}} -
                                                            {{date("d M, Y",strtotime($course->end_date))}}

                                                        </span>
                                                        {{-- <p class="font-small-2 text-muted danger"> behind</p> --}}
                                                    </td>
                                                    <td>
                                                        @if($course->status == 1)
                                                            <span class="text-success">Active</span>
                                                        @else
                                                            <span class="text-muted">Inactive</span>
                                                        @endif


                                                        {{-- <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                            <div class="progress-bar bg-gradient-x-danger"
                                                                role="progressbar" style="width: 85%" aria-valuenow="85"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
@extends('layouts.admin')
@section('title', 'Add Topic')
@section('css')
@endsection
@section('content')

<div class="app-content content pt-2 pb-2" >
    
    <div class="col-12">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header col-12">
                <h4 class="card-title">Add Praise Message </h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <a href="{{ route('topics', $course->id) }}" class="">< Topics List</a>
                    </ul>
                </div>
                <hr>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <small>Course:</small>
                            <h3 class="">{{$course->title}}</h3>
                        </div>
                        <div class="col-md-12">
                            <form action="{{ route('topic.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="desig">Title</label>
                                        <input type="Text" class="form-control" name="title" id="title" value="{{ old('title') }}" placeholder="Give some title">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="name">Topic Index</label>
                                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                                        <input type="Text" class="form-control" name="topic_index" id="topic_index" value="{{ old('topic_index') }}" placeholder="Topic">
                                        @error('topic_index')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="desig">Unpack Standard</label>
                                        <input type="Text" class="form-control" name="unpack_standard" id="unpack_standard" value="{{ old('unpack_standard') }}" placeholder="Unpack code">
                                        @error('unpack_standard')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="email-addr">Live Sessions</label>
                                        <input type="text" class="form-control" name="live_sessions" id="live_sessions" value="{{ old('live_sessions') }}" placeholder="Number of sessions">
                                        @error('live_sessions')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form- col-12 mb-2">
                                        <label for="tel-input">Objectives</label>
                                        <textarea class="form-control" name="objectives" rows="5" id="objectives">{{ old('objectives') }}</textarea>
                                        @error('objectives')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<!-- BEGIN: Page Vendor JS-->
{{-- <script src="{{ asset('public') }}/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js" type="text/javascript"></script> --}}
<!-- END: Page Vendor JS-->
<!-- BEGIN: Page JS-->
{{-- <script src="{{ asset('public') }}/app-assets/js/scripts/forms/form-repeater.js" type="text/javascript"></script> --}}
<!-- END: Page JS-->
@endsection
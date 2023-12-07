@extends('layouts.admin')
@section('title', 'Edit Topic')
@section('css')
@endsection
@section('content')

<div class="app-content content pt-2 pb-2">
    
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
                        <a href="{{ route('topics', $topic->course->id) }}" class="">< Topics List</a>
                    </ul>
                </div>
                <hr>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('topic.update') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="desig">Title</label>
                                        <input type="Text" class="form-control" name="title" id="title" value="{{ $topic->title }}" placeholder="Give some title">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="name">Topic</label>
                                        <input type="hidden" name="course_id" value="{{  $topic->course->id }}">
                                        <input type="hidden" name="topic_id" value="{{  $topic->id }}">
                                        <input type="Text" class="form-control" name="topic_index" id="topic_index" value="{{ $topic->topic_index }}" placeholder="Topic">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="desig">Unpack Standard</label>
                                        <br>
                                        <input type="Text" class="form-control" name="unpack_standard" id="unpack_standard" value="{{ $topic->unpack_standard }}" placeholder="Unpack code">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="email-addr">Live Sessions</label>
                                        <br>
                                        <input type="text" class="form-control" name="live_sessions" id="live_sessions" value="{{ $topic->live_sessions }}" placeholder="Number of sessions">
                                    </div>
                                    <div class="form- col-12 mb-2">
                                        <label for="tel-input">Objectives</label>
                                        <br>
                                        <textarea class="form-control" name="objectives" rows="5" id="objectives">{{ $topic->objectives }}</textarea>
                                    </div>
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary">
                                            Update
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
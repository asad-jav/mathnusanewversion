@extends('layouts.admin')
@section('title', 'Edit Praise')
@section('css')
@endsection
@section('content')

<div class="app-content content pt-2 pb-2" style="overflow: scroll;">
    
    <div class="col-12">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Praise Message </h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <a href="{{ url('praise') }}" class="">< Praise List</a>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <form action="{{ url('praise/update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Message</label>
                            <input type="text" name="msg" id="msg" value="{{ $praise->msg }}" class="form-control" placeholder="Message">
                            @error('msg')
                                <span class="text-danger">The message field is required</span>
                            @enderror
                            <input type="hidden" name="id" value="{{$praise->id}}">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Save" placeholder="Lectures">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
@endsection
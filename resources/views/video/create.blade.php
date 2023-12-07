@extends('layouts.admin')
@section('title', 'Add Video')
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
                <h4 class="card-title">Add Video </h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <form action="{{ url('video/store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" placeholder="Title goes here...">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Video Link</label>
                                    <input type="text" name="link" id="link" value="{{old('link') }}" class="form-control" placeholder="http://www">
                                    @error('link')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Type</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="" hidden>Select Video Type</option>
                                        <option value="1">Tutorial</option>
                                    </select>
                                    @error('type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description" id="description" class="form-control" cols="30" rows="10" placeholder="Give description...">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Add Video" placeholder="Lectures">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   
</div>

@endsection
@section('script')
    <script>
        @if (Auth::check()) 
            $('#gender').val("{{ Auth::user()->gender }}")
        @endif
    
        @if (Auth::check()) 
            $(document).ready(function(){
                $('.country').val("{{ Auth::user()->country }}");
            });
        @endif

        @if (Session::has('previous_password'))
            $('#previous_password').focus();
        @endif
    </script>
@endsection
@extends('layouts.admin')
@section('title', 'Create standards')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" integrity="sha512-ngQ4IGzHQ3s/Hh8kMyG4FC74wzitukRMIcTOoKT3EyzFZCILOPF0twiXOQn75eDINUfKBYmzYn2AA8DkAk8veQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')

<div class="app-content content pt-2 pb-2 p-2">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create Standards</h4> 
                </div>
                <div class="card-content collapse show">
                    <div class="card-body"> 
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{Session::get('success')}}
                        </div>
                        @endif
                        @if (Session::has('failure'))
                        <div class="alert alert-danger">
                            {{Session::get('failure')}}
                        </div>
                        @endif
                        <form action="{{ route('standards.store') }}" method="POST">
                        @csrf 
                            <div class="form-group">
                                <label for="grades">Grades</label>
                                <select type="select" name="grades" id="grades" class="form-control @error('grades') is-invalid @enderror">
                                    <option value="" disabled selected>-- Select Grade --</option>
                                    @foreach($grades as $grade)        
                                      <option value="{{$grade->id}}">{{$grade->name}}</option>
                                    @endforeach
                                </select>
                                @error('main_standard')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> 
                            <div class="form-group">
                                <label for="main_standard">Main Standard</label>
                                <select type="select" name="main_standard" id="main_standard" class="form-control @error('main_standard') is-invalid @enderror">
                                    <option value="" disabled selected>-- Select main standard --</option>
                                    @foreach($standards as $standard)        
                                      <option value="{{$standard->id}}">{{$standard->title}}</option>
                                    @endforeach
                                </select>
                                @error('main_standard')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> 
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> 
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea type="description" name="description" id="description" class="form-control summernote @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>     
                            <button type="submit" class="btn btn-primary mt-2">Submit</button>  
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    </div> 
</div> 
@endsection 
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js" integrity="sha512-6rE6Bx6fCBpRXG/FWpQmvguMWDLWMQjPycXMr35Zx/HRD9nwySZswkkLksgyQcvrpYMx0FELLJVBvWFtubZhDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function() {
    $('.summernote').summernote();
});
</script>
@endsection
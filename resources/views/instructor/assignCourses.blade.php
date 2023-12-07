@extends('layouts.admin')
@section('title', 'Assign Courses')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/vendors/css/forms/selects/select2.min.css')}}">
<style>
    .select2-container--default .select2-search--inline .select2-search__field{
        padding-left: 36px;
    }
</style>
@endsection
@section('content')

<div class="app-content content pt-2 pb-2" style="overflow: scroll;">
    <div class="col-12">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif
        @if (Session::has('failure'))
            <div class="alert alert-danger">
                {{Session::get('failure')['message']}}
                <ul>
                    @foreach (Session::get('failure')['sections'] as $section)
                        <li>{{$section->course->title}} section {{$section->name}} already assigned to {{$section->user->first_name}} {{$section->user->last_name}}</li>


                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
            @php
                $user = App\Models\User::find(request('user_id'));
            @endphp
                <h4 class="card-title">Courses assigning &#8594; {{$user->first_name}} {{$user->last_name}} </h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <a href="{{ route('admin.instructors') }}" class="btn btn-primary py-1 px-1 box-shadow-1">Assign Later</a>
                    </ul>
                </div>
            </div>
            
            <div class="card-content collapse show">
                <div class="card-body">
                    <div class="form-group">
                        <label for="my-select">Select Course</label>
                        <select class="select2 custom-select" name="courses[]" id="courses" multiple data-user="{{request('user_id')}}" style="width:100%">
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}" @if($user->courses->contains($course->id)) selected @endif > {{ $course->title }}</option>
                            @endforeach
                        </select>
                        @error('courses')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="my-select" class="py-1">Sections</label>
                        <div id="sections"></div>
                        @error('courses')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('backend/app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Page JS-->
<script src="{{ asset('backend/app-assets/js/scripts/forms/select/form-select2.js') }}" type="text/javascript"></script>
<!-- END: Page JS-->
    <script>
        $('#course').select2({
            placeholder: "Select courses",
        });

        function getSections(courses,sections,user){
            $.ajax({
                url : "{{ url('dashboard/fetch/course/sections') }}",
                type : "post",
                data:{courses:courses,user_id:user , _token:'{{csrf_token()}}'},
                success:function(data) {
                    if(data) {
                        sections.html(data);
                    } else {
                        sections.html('No section found');
                    }
                }
            });
        }
        
        $(document).ready(function (){
            var courses = $('#courses').val();
            var sections = $('#sections');
            var user = $('#courses').data('user');
            getSections(courses,sections,user);
        });

        $('#courses').on('change',function(){
            var courses = $(this).val();
            var sections = $('#sections');
            var user = $(this).data('user');
            getSections(courses,sections,user);
        });
    </script>
@endsection
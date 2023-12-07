@extends('layouts.admin')
@section('title', 'All Courses')
@section('css')
@endsection
@section('content')

<div class="app-content content pt-2 pb-2" style="overflow: scroll;">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All Courses ({{ $courses->count() }})</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <a href="{{ route('sections') }}" class="">All Sections </a>/
                        <a href="{{ url('course/create') }}" class=""> Create Course ></a>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="w-20">Course Name</th>
                                    <th class="w-20">Category</th>
                                    <th class="w-10">Lectures</th>
                                    <th class="w-10">Grade</th>
                                    <th>Total Seats</th>
                                    <th class="w-10">USD</th>
                                    <th class="w-10">KWD</th>
                                    <th>Session</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($courses as $course)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>
                                            <a href="{{ url('course/lectures/'.$course->id) }}" title="See Lectures">{{ $course->title }}</a>
                                        </td>
                                        <td>{{ $course->category->name }}</td>
                                        <td>{{ $course->number_of_lectures }}</td>
                                        <td>{{ $course->grade->name }}</td>
                                        <td>{{ $course->seats }}</td>
                                        <td>{{ $course->amount_in_usd }} USD</td>
                                        <td>{{ $course->amount_in_kwd }} KWD</td>
                                        <td>{{ $course->start_date }} &RightArrow; {{$course->end_date}} </td>
                                        <td>
                                            <select data-id="{{ $course->id }}" class="status">
                                                <option value="1" @if($course->status == App\Models\Course::ACTIVE) selected @endif>Active</option>
                                                <option value="0" @if($course->status == App\Models\Course::INACTIVE) selected @endif>Inactive</option>
                                            </select>
                                        </td>
                                        <td style="text-align: right; width:230px">
                                            <div class="form-group">
                                                <a href="{{ route('topics',$course->id) }}" class=""> Topics </a>|
                                                <a href="{{ url('course/edit/'.$course->id) }}" class=""> Edit </a>|
                                                <a href="{{ url('course/delete/'.$course->id) }}" class=" confirm">Delete</a>
                                            </div> 
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

@endsection
@section('script')
<script>
    $('.status').change(function(){
        var course_id = $(this).data('id');
        var status = $(this).val();
        $.ajax({
            url:"{{ url('ajax/course/status') }}",
            type:"post",
            data:{course_id:course_id, status:status, _token:'{{ csrf_token() }}'},
            success:function(data){
                alert(data.message);
            }
        });
    });
</script>
@endsection
@extends('layouts.admin')
@section('title', 'Instructor Courses')
@section('css')
@endsection
@section('content')

<div class="app-content content page pt-2 pb-2" style="overflow: scroll;">
    <div class="col-12">
        @if (Session::has('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning!</strong> {{Session::get('warning')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Course: {{$course->title}} ({{$section->name}})</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <a href="{{ URL::previous() }}" class=""> < Back</a>
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
                                    <th class="w-20">Lecture Name</th>
                                    <th class="w-10">Course Name</th>
                                    <th class="w-10">Topic</th>
                                    <th>Duration</th>
                                    <th>Date & Time</th>
                                    <th>Number</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                    $currentTime = Carbon\Carbon::createFromTimestamp(strtotime(date('Y-m-d H:i:s')))
                                            ->timezone(Auth::user()->timezone);
                                @endphp
                                @foreach ($lectures as $lecture)
                                    <tr>
                                        @php
                                            $lectureTime = Carbon\Carbon::parse($lecture->datetime.' '.$lecture->start_time)->setTimezone(Auth::user()->timezone);
                                        @endphp
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $lecture->title }}</td>
                                        <td>{{ $lecture->course->title }}</td>
                                        <td>{{ $lecture->topic->title }}</td>
                                        <td>{{ $lecture->duration }}</td>
                                        <td>{{ $lectureTime }}</td>
                                        <td>{{ $lecture->lecture_number }}</td>
                                        <td style="text-align: right; width:230px">
                                            @if($lectureTime->addMinutes($lecture->duration*60)->isPast() && $lecture->state == App\Models\Lecture::ENDED)
                                                {{-- view class button --}}
                                                <div class="form-group">
                                                    <a class="btn btn-sm btn-outline-secondary" href="{{ url('class/lecture/'.$lecture->id) }}" >View Lecture</a>
                                                </div>
                                            @else
                                                <div class="form-group dropdown">
                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary  dropdown-toggle-split dropdown-toggle lecture-{{ $lecture->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display: @if($lecture->state == 0) none @endif">
                                                        Join Lecture
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                        <a class="dropdown-item" href="{{ url('class/lecture/'.$lecture->id) }}">Chat</a>
                                                        <a class="dropdown-item" target="_blank" href="{{url('class/whiteboard',$lecture->id)}}">White Board</a>
                                                        </div>
                                                    </div> 
                                                </div> 
                                            @endif
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
    Pusher.logToConsole = true;

    var pusher = new Pusher('f3c210bf9315513605e3', {
    cluster: 'ap2'
    });

    var channel = pusher.subscribe('change_lecture_state');
    channel.bind('my-event', function(data) {
        console.log(data);
        var channel_name = "lecture-"+data.lecture.id;
        console.log('listner is working');
        if(data.lectureState == 1) {
            $(document).find('.'+channel_name).show();
        } else {
            $(document).find('.'+channel_name).hide();
        }
    });
</script>
@endsection
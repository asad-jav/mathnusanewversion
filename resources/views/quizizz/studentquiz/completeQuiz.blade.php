@extends('layouts.admin')
@section('title', 'Complete CFU')
@section('css')
<link rel="stylesheet" href="{{asset('public/assets/font-awesome.min.css')}}">
<style>
    .quiz-card {
        padding: 5px 20px 20px 20px;
        box-shadow: 0 7px 15px 0 rgb(0 0 0 / 10%);
        background-color: #FFF;
        border-top: 3px solid rgb(118 151 255);
        margin-bottom: 30px;
    }

    .quiz-name {
        font-size: 22px;
    }

    .quiz-card p {
        font-size: 13px;
    }

    .topic-detail {
        margin: 10px 0 20px;
        list-style-type: none;
        -webkit-padding-start: 0;
    }

    .topic-detail li {
        margin-bottom: 6px;
        position: relative;
    }

    .topic-detail li .ft-arrow-right {
        position: absolute;
        right: 0;
        top: 3.5px;
        color: #2196f3;
    }
    .ft-arrow-right {
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
.row {
    margin-right: -15px;
    margin-left: -15px;
}
.row:before {
    display: table;
    content: " ";
}
.row:after{ 
    clear: both; 
}   
.row:after{
    display: table;
    content: " ";
}
.col-xs-6 {
    width: 50%;
}
.col-xs-6 {
    position: relative;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
}
.col-xs-6{
    float: left;
}
</style>
@endsection
@section('content')

<div class="app-content content pt-2 pb-2">
    <div class="col-12">
        @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
        @endif
        @if (Session::has('failure'))
        <div class="alert alert-danger">
            {{ Session::get('failure') }}
        </div>
        @endif
        <h1> Complete CFU </h1>
        <div class="row mt-4">
            @if(count($quizizzes) > 0)
            @foreach($quizizzes as $quiz)
            <div class="col-md-4">
                <div class="quiz-card">
                    <h3 class="quiz-name mt-1">{{$quiz->quiz->title ?? ''}}</h3>
                    <p title="{{$quiz->quiz->description}}">
                        {{$quiz->quiz->description}}
                    </p>
                    <div class="row">
                        <div class="col-xs-6 pad-0">
                            <ul class="topic-detail"> 
                                <li>Total Marks <i class="ft-arrow-right"></i></li>
                                <li>Total Questions <i class="ft-arrow-right"></i></li>
                                <li>Completed Date <i class="ft-arrow-right"></i></li>
                                <li>Result Status <i class="ft-arrow-right"></i></li>
                            </ul>
                        </div>
                        <div class="col-xs-6">
                            <ul class="topic-detail right"> 
                                <li>
                                    {{$quiz->quiz->totalquestions->sum('points')}}
                                </li>
                                <li>
                                
                                {{$quiz->quiz->totalquestions->count()}}
                                </li>
                                <li>
                                {{date('Y-m-d',strtotime($quiz->recorded_on))}}
                                </li> 
                                <li>
                                    @if($quiz->quiz->report_status == 0)
                                        <span class="badge badge-danger">Pending</span>
                                    @elseif($quiz->quiz->report_status == 1)
                                        <span class="badge badge-success">Active</span>
                                    @endif 
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <hr>
                            @if($quiz->quiz->report_status == 0)
                            <button class="btn btn-warning text-white" disabled>Pending Report</button>
                            @elseif($quiz->quiz->report_status == 1) 
                            <a href="{{url('student/quizizz/report',$quiz->id)}}" class="btn btn-success text">Show Report</a>
                            @endif 
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else 
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 style="margin-left: 40px;">No Quizz Found</h4>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
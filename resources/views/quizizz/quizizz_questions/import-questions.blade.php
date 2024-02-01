@extends('layouts.admin')
@section('title', 'All CFU Question')
@section('css')
<style>
    .right {
        float: right !important;
    }

    .left {
        float: left !important;
    }

    .alert-danger {
        color: #f44336 !important;
        background-color: #fee0e19c !important;
        border-color: #fed3d6 !important;
    }
</style>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
        <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
        <script type="text/x-mathjax-config">MathJax.Hub.Config({tex2jax: {inlineMath: [['\\(','\\)']]}});</script>
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
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <span class="">All CFU Quesiton </span>
                </h4>
                <p class="mt-2">
                    <span class="">Total Questions : {{$quiz->total_questions}}</span>
                </p>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                    <a href="{{url('/quizizz')}}" class="btn btn-danger"><i class="ft-arrow-left"></i>Back</a>
                    @if($quiz->status == 2)
                    @else
                    <a href="{{url('quizz-question/create',$quiz->id)}}" class="btn btn-primary"><i class="ft-plus"></i> Add New Question</a>
                    @endif
                    <a href="#" class="btn btn-success text-white">Import Questions</a>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <div class="toast" role="toast" aria-live="assertive" aria-atomic="true" data-delay="5000">
                        <div class="toast-header">
                            <strong class="mr-auto">Success</strong>
                            <button type="button" class="ml-1 close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="toast-body">

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Quesiton</th>
                                    <th>Type</th>
                                    <th>Choices</th>
                                    <th>Media</th>
                                    <th>Answer</th>
                                    <th>Points</th> 
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($questions as $key => $question)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{!! $question->question !!}</td>
                                    <td>
                                        @if($question->question_type == 1) 
                                            <span class="badge badge-primary">Identification</span>
                                        @elseif($question->question_type == 2) 
                                            <span class="badge badge-warning">Multiple Choice</span>
                                        @elseif($question->question_type == 3) 
                                            <span class="badge badge-success">True or False</span>
                                        @endif
                                    </td>
                                    <td> {{$question->choices}} </td>
                                    <td> 
                                        @if($question->image_link)   
                                        <img src="{{asset($question->image_link)}}" height="80" width="130">
                                        @elseif($question->video_link) 
                                        <iframe src="{{$question->video_link}}" height="80" width="130"></iframe>
                                        @else
                                        @endif
                                    </td>
                                    <td> {{$question->answer}} </td>
                                    <td> {{$question->points}} </td>
                                    <td>
                                        <div class="form-group">
                                            <a href="{{ url('quizz-question/edit', $question->id) }}" class="">Edit </a>|
                                            <a href="{{ url('quizz-question/delete', $question->id) }}" class=" confirm"> Delete</a>
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
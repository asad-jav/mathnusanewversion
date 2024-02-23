@extends('layouts.admin')
@section('title', 'Students CFU Answers')
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
    .modal{
        overflow: scroll;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('content')

<div class="app-content content pt-2 pb-2">
    <div class="col-12">
        @if (session('status') == 'success')
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        @if (session('status') == 'failure')
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <span class="">{{$cuf_answers->student->first_name ?? ''}} {{$cuf_answers->student->last_name ?? ''}} Quizizz answers</span>
                </h4>
                <p class="mt-2">
                    <span class="">CFU Name : {{$cuf_answers->quiz->title ?? ''}}</span>
                </p>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <a href="{{url('student/quizizz/report',$cuf_answers->quiz->id)}}" class="btn btn-danger"><i class="ft-arrow-left"></i>Back</a>
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
                                    <th>Question</th>
                                    <th>Type</th>
                                    <th>Question Answer</th>
                                    <th>Student Answer</th>
                                    <th>Question Points</th>
                                    <th>Obtained Points</th>
                                    <th>Status</th> 
                                    <th>Feedback</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($cuf_answers->student_answers) > 0)
                                @foreach($cuf_answers->student_answers as $key => $quiziz)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{!! $quiziz->question->question ?? '' !!}</td>
                                    <td>
                                        @if($quiziz->question->question_type == 1)
                                        <span class="badge badge-primary">Identification</span>
                                        @elseif($quiziz->question->question_type == 2)
                                        <span class="badge badge-success">Multiple Choice</span>
                                        @elseif($quiziz->question->question_type == 3)
                                        <span class="badge badge-secondary">True or False</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($quiziz->question->question_type == 1)
                                        @elseif($quiziz->question->question_type == 2)
                                        {{$quiziz->question->answer ?? ''}}
                                        @elseif($quiziz->question->question_type == 3)
                                        @if( $quiziz->question->answer == 1)
                                        <span class="badge badge-success">True</span>
                                        @elseif($quiziz->question->answer == 0)
                                        <span class="badge badge-danger">False</span>
                                        @endif
                                        @endif

                                    </td>
                                    <td class="text-center">
                                        @if($quiziz->question->question_type == 1)
                                        {{$quiziz->student_answer ?? ''}}
                                        @elseif($quiziz->question->question_type == 2)
                                        {{$quiziz->student_answer ?? ''}}
                                        @elseif($quiziz->question->question_type == 3)
                                        @if($quiziz->student_answer == 1)
                                        <span class="badge badge-success">True</span>
                                        @elseif($quiziz->student_answer == 0)
                                        <span class="badge badge-danger">False</span>
                                        @endif
                                        @endif
                                    </td>

                                    <td class="text-center">{{$quiziz->question->points ?? ''}}</td>
                                    <td class="text-center">{{$quiziz->score ?? ''}}</td>
                                    <td class="text-center">
                                        @if($quiziz->status == 1)
                                        <span class="badge badge-success">Marked</span>
                                        @elseif($quiziz->status == 0)
                                        <span class="badge badge-danger">Un Marked</span>
                                        @endif
                                    </td>
                                    <td class="text-center">

                                        @if($quiziz->feedback)
                                        <a  href="javascript:void(0)" onclick="editStudenQuiz('{{$quiziz->feedback}}')" title="Feedback" data-toggle="tooltip">Feedback</a>
                                      
                                        @endif
                                    </td>

                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="6" class="text-center">
                                        Record Not Found
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="answertool" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mark the answer points</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group" id="editmark">
                   

                </div>
            </div> 
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script type="text/javascript">
   

    function editStudenQuiz(cuf){
        // var quizz = JSON.parse(cuf);
        console.log(cuf);
        $("#editmark").html('');
        $("#editmark").append('<div class="form-group">\
                            <label>Instructor Feedback: </label><br><div class="container">'+cuf+'</div>\
                        </div>');
                    $('#answertool').modal('show');

    }  

</script>
@endsection
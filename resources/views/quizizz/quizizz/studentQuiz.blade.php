@extends('layouts.admin')
@section('title', 'Students Quizizz')
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
                    <span class="">All Student Quizizz</span>
                </h4>
                <p class="mt-2">
                    <span class="">Quiz Name : {{$quiz->title ?? ''}}</span>
                </p>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                    <a href="{{url('/quizizz')}}" class="btn btn-danger"><i class="ft-arrow-left"></i>Back</a> 
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
                                    <th>Student Name</th>
                                    <th>Record On</th>
                                    <th>Completed Answer</th>
                                    <th>Pending Answer</th>
                                    <th>Obtained Points</th> 
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @if(count($quizizz) > 0)
                                @foreach($quizizz as $key => $quiziz) 
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$quiziz->student->first_name ?? ''}} {{$quiziz->student->last_name ?? ''}}</td>
                                    <td>{{date('Y-m-d',strtotime($quiziz->recorded_on))}}</td>
                                    <td class="text-center"><span class="badge badge-primary">{{$quiziz->student_answers->where('status',1)->count() ?? 0}}</span></td>
                                    <td class="text-center"><span class="badge badge-success">{{$quiziz->student_answers->where('status',0)->count() ?? 0}}</span></td>
                                    <td class="text-center"><span class="badge badge-secondary">{{$quiziz->student_answers->sum('score') ?? 0}}</span></td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="btn btn-primary btn-sm" href="{{url('student/quizizz/answers/'.$quiziz->id.'/'.$quiziz->student_id)}}" title="View students answers"><i class="ft-eye"></i></a>
                                        </div>
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
@endsection 
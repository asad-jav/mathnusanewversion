@extends('layouts.admin')
@section('title', 'All CFU')
@section('css')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
        <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
        <script type="text/x-mathjax-config">MathJax.Hub.Config({tex2jax: {inlineMath: [['\\(','\\)']]}});</script>
<style>
    .card-body{
        padding: 0px !important;
    }
    h3{
        margin-right: 10px;
        margin-left: 8px;
        margin-top: 10px;
        font-weight: bold;
    }
    .customdiv{    
        border-left: 4px solid #3f51b5;
        margin-top: 10px;
        display:flex;
        font-size: 1.51rem;
        margin-bottom: 15px;
        box-shadow: 0px 1px 15px 1px rgb(158 158 158 / 46%);
    }
    .customdiv p {
        font-size: 1.51rem;
        margin-top: 3px;
        margin-left: 8px; 
    }
    .customdiv img, .customdiv iframe{
        margin-left: 6px;    
        border: 1px solid #9e9e9e;
    }
    .steps  ul{
        display: none !important;
    }
    .form-check-label{
        font-size:1.51rem;
    }
    .form-inline .form-check {
        display: table;
    }
    
    .form-inline {
        display: block;
    } 
    .form-check-input{
        width: 25px;
        height: 20px;
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
        <div class="card">
            <div class="card-header bg-primary bg-lighten-1">
                <h4 class="card-title  text-white ">
                    <span class="">{{$quizizzes->title}}</span>
                </h4>
                <div class="heading-elements">
                    <span class="text-white ">Total Question: {{count($questions)}}</span>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">  
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
                    @php $questionNum = 1; @endphp
                    <form action="{{url('student/quizizz/save')}}" method="Post" class="steps-validations">
                        @csrf
                        <input type="hidden" name="quiz_id" value="{{$quizizzes->id}}"> 
                        @foreach($questions as $quiz)

                        <!-- Step 1 -->
                        <h6>Questions {{ $questionNum }}</h6>
                        <fieldset>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div  class="customdiv">
                                        <h3 class="text-primary">    Q#{{ $questionNum }} : </h3> {!! $quiz->question !!}<br>
                                        @if($quiz->image_link)
                                            <img src="{{asset($quiz->image_link)}}" height="220px" width="250px">
                                        @elseif($quiz->video_link) 
                                            <iframe src="{{$quiz->video_link}}" height="220px" width="250px"></iframe>
                                        @endif 
                                    </div>
                                    &nbsp
                                    @if($quiz->question_type == 1)
                                     
                                    <div class="form-group">
                                        <textarea class="form-control" name="answer[{{ $quiz->id }}]" rows="3" placeholder="Input answer here..."></textarea>
                                    </div>

                                    @elseif($quiz->question_type == 2)
                                     
                                    @php
                                    $choices = explode(";", $quiz->choices);
                                    $choicenum = 1;
                                    @endphp
                                    <div class="form-group">
                                        <div class="form-inline">
                                            @foreach($choices as $choice)
                                            <div class="form-check">
                                                <label for="mc_c{{ $choicenum }}" class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="answer[{{ $quiz->id }}]" id="mc_c{{ $choicenum }}" value="{{ $choice }}">
                                                    {{ $choice }}
                                                </label>
                                            </div>
                                            &nbsp  
                                            @endforeach
                                        </div>
                                    </div>

                                    @elseif($quiz->question_type == 3) 
                                    <div class="form-group">
                                        <div class="form-inline">
                                            <div class="form-check ">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="answer[{{ $quiz->id }}]" value="1">
                                                    True
                                                </label>
                                            </div>
                                            &nbsp  
                                            <div class="form-check ">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="answer[{{ $quiz->id }}]" value="0">
                                                    False
                                                </label>
                                            </div>
                                        </div> 
                                    </div>
                                    @endif
                                    <hr>
                                    <div class="form-group">
                                        
                                    </div>
                                </div>
                            </div>

                        </fieldset>
                        @php $questionNum ++; @endphp
                        @endforeach
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    var form = $(".steps-validations").show();

$(".steps-validations").steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: 'Submit'
    },
    onStepChanging: function (event, currentIndex, newIndex)
    {
        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex)
        {
            return true;
        }
        // Forbid next action on "Warning" step if the user is to young
        if (newIndex === 3 && Number($("#age-2").val()) < 18)
        {
            return false;
        }
        // Needed in some cases if the user went back (clean up)
        if (currentIndex < newIndex)
        {
            // To remove error styles
            form.find(".body:eq(" + newIndex + ") label.error").remove();
            form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
        }
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex)
    {
        form.submit();
    }
});
</script>
@endsection
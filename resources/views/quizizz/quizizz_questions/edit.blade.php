@extends('layouts.admin')
@section('title', 'Edit CFU Question')
@section('css')
<style>
    .btn-primary {
        background-color: #6967CE;
        color: #FFFFFF !important;
    }

    .right {
        float: right !important;
    }
    .left {
        float: left !important;
    }

    .matheditor-btn-span {
        width: 50px !important;
        height: 36px !important;
    }

    div[class^="matheditor-wrapper-"] ul[class^="tabs-"] li {
        height: 28px !important;
    }

    .tox-silver-sink {
        display: none;
    }

    .btn-file {
        position: relative;
        overflow: hidden;
    }

    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }

    #img-upload {
        width: 100%;
    }
    .img-upload{
        height: 400px;
        border: 1px solid #607d8b;
    }
    .customimage{
        height: 285px;
    }
    .customvideo{
        height: 285px;
    }
    #firstdiv .row{
        text-align: center;
        margin-top: 38px;
    }
    .tox-menubar{
        display: none !important;
    }
</style>
<link href="{{asset('backend/css/lib/mathquill.css')}}" rel="stylesheet">
<link href="{{asset('backend/css/lib/matheditor.css')}}" rel="stylesheet">
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
                    Create New CFU Question 
                </h4>
            </div>
            <div class="card-body">
                <form method="Post" action="{{url('quizz-question/update',$question->id)}}" enctype="multipart/form-data" novalidate>
                    @csrf 
                    <input type="hidden" name="quiz_id" value="{{$question->quiz_id}}">
                    <div class="row">
                        <div class="col-md-2" id="firstdiv" style="@if($question->image_link || $question->video_link) display: none;  @else display: block; @endif">
                            <div class="row">
                                <div class="col-md-12">
                                    <a class="btn btn-primary btn-min-width mr-1 mb-1" style="font-size: 20px;" data-toggle="modal" data-target="#imagetool"><i class="ft-image"></i> <br> Image</a>
                                </div> 
                                <div class="col-md-12">
                                    <a class="btn btn-primary btn-min-width mr-1 mb-1" style="font-size: 20px;"  data-toggle="modal" data-target="#videotool"><i class="ft-video"></i> <br> Video</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3" id="seconddiv" style="@if($question->image_link || $question->video_link) display: block;  @else display: none; @endif"> 
                            <div class="customimage"  style="@if($question->image_link) display: block; @else display: none; @endif">
                                <a href="javascript:void(0)" class="btn btn-primary"  data-toggle="modal" data-target="#imagetool"><i class="ft-edit-3"></i></a>
                                <a href="javascript:void(0)" class="btn btn-primary clear"><i class="ft-trash"></i></a>
                                <img id='img-upload' src="{{asset($question->image_link)}}" class="img-upload" style="height: 243px !important;" />
                                <!-- <iframe src=""  width="100%" height="243" class="youtub-url"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen > </iframe> -->
                                        
                            </div>
                            <div class="customvideo"  style="@if($question->video_link) display: block; @else display: none; @endif">
                                <a href="javascript:void(0)" class="btn btn-primary"  data-toggle="modal" data-target="#videotool"><i class="ft-edit-3"></i></a>
                                <a href="javascript:void(0)" class="btn btn-primary videoclear"><i class="ft-trash"></i></a>
                                <iframe src="{{$question->video_link}}"  width="100%" height="243" class="youtub-url"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen > </iframe>
                                        
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row"> 
                                <div class="col-md-12" >
                                    <h4 class="form-section">
                                        <i class="ft-target"></i> Question
                                    </h4>
                                    <div class="form-group">
                                        <textarea class="form-control tinymce-editor round" rows="5" type="text" name="quesiton" placeholder="Enter Question" id="question" required>{{old('question',$question->question)}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="question_type">Question Type</label>
                                        <select class="form-control round" type="text" name="question_type" id="question_type" required>
                                            <option value="">--Select Question Type--</option>
                                            <option value="1" {{old('question_type',$question->question_type) == 1 ? 'selected' : ''}}>Identification</option>
                                            <option value="2" {{old('question_type',$question->question_type) == 2 ? 'selected' : ''}}>Multiple Choice</option>
                                            <option value="3" {{old('question_type',$question->question_type) == 3 ? 'selected' : ''}}>True or False</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="question_type">Difficulty Level</label>
                                        <select class="form-control round @error('difficulty_level') is-invalid @enderror" type="text" name="difficulty_level" id="difficulty-level" required>
                                            <option value="" selected disabled>--Select Difficulty Level --</option>
                                            <option value="1" {{$question->difficulty_level == '1' ? 'selected':''}}>Easy</option>
                                            <option value="2" {{$question->difficulty_level == '2' ? 'selected':''}}>Average</option>
                                            <option value="3" {{$question->difficulty_level == '3' ? 'selected':''}}>Difficult</option>
                                            <option value="4" {{$question->difficulty_level == '4' ? 'selected':''}}>Very Difficult</option>
                                        </select>
                                        @error('difficulty_level')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="points">Points</label>
                                        <input class="form-control round" min="0" type="number" value="{{old('points',$question->points)}}" name="points" placeholder="Enter Points" id="points" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" >
                            <h4 class="form-section">
                                <i class="ft-target"></i> Answers
                            </h4> 
                            <div class="row"  id="identifications">
                               @if($question->question_type == 1)
                               <div class="col-md-12 form-group">
                                    <label for="">Correct answer</label>
                                    <textarea type="text" class="form-control round" id="identification" name="identification" placeholder="Correct answer here..." required>{{$question->answer}}</textarea>
                                </div>
                               @endif
                            </div>                            
                            <div class="row" id="mcqs"> 
                                @if($question->question_type == 2)
                                @php $mcqs = explode(';',$question->choices) @endphp
                                <div class="col-md-3"><label>Choice 1</label><input name="mcq[]" type="text" value="{{$mcqs[0] ?? ''}}" class="form-control round"></div> 
                                <div class="col-md-3"><label>Choice 2</label><input name="mcq[]" type="text" value="{{$mcqs[1] ?? ''}}"  class="form-control round"></div> 
                                <div class="col-md-3"><label>Choice 3</label><input name="mcq[]" type="text" value="{{$mcqs[2] ?? ''}}"  class="form-control round"></div> 
                                <div class="col-md-3"><label>Choice 4</label><input name="mcq[]" type="text" value="{{$mcqs[3] ?? ''}}"  class="form-control round"></div>
                               @endif
                            </div>
                            <div class="row" id="correctchoices">
                                @if($question->question_type == 2)
                                <div class="col-md-12">  
                                    <label for="">Correct choice</label> 
                                    <select  name="correctchoice" class="form-control round" required> 
                                        <option value="">--Select Correct choice--</option> 
                                        <option value="0" {{$mcqs[0] == $question->answer ? 'selected' : ''}}>Choice 1</option> 
                                        <option value="1" {{$mcqs[1] == $question->answer ? 'selected' : ''}}>Choice 2</option> 
                                        <option value="2" {{$mcqs[2] == $question->answer ? 'selected' : ''}}>Choice 3</option> 
                                        <option value="3" {{$mcqs[3] == $question->answer ? 'selected' : ''}}>Choice 4</option> 
                                    </select> 
                                </div>
                               @endif
                            </div>
                            <div class="row" id="truefalses">
                                @if($question->question_type == 3)
                                <div class="col-md-12"> 
                                    <label for="">Correct answer</label> 
                                    <select name="truefalse" id="truefalse" class="form-control round" required> 
                                        <option value="">--Select correct answer--</option> 
                                        <option value="1" {{$question->answer == 1 ? 'selected' : ''}}>True</option> 
                                        <option value="0" {{$question->answer == 0 ? 'selected' : ''}}>False</option> 
                                    </select> 
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-actions">
                                <a href="{{url('quizizz',$question->quiz_id)}}" class="btn btn-danger mr-1 left">
                                    <i class="ft-x"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary right">
                                    <i class="la la-check-square-o"></i> Update
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- End video upload modal  -->
                   
                      <!-- Image Upload Modal -->
                      <div class="modal fade" id="imagetool" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Insert an image</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Upload Image</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <span class="btn btn-default btn-file">
                                                    Browse… <input type="file" name="image" accept="image/png, image/jpeg, image/gif" id="imgInp">
                                                </span>
                                            </span>
                                            <input id='urlname' type="text" value="{{$question->image_link}}" class="form-control" readonly>
                                            <a class="btn btn-danger clear" href="javascript:void(0)">Clear</a>
                                        </div>
                                        <img id='img-upload' class="img-upload" src="{{asset($question->image_link)}}" />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Image Upload Modal  -->
                    <div class="modal fade" id="videotool" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Insert a video</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                
                                <input   type="hidden" class="form-control" name="video_links" id="video_links"  value="{{$question->video_link}}"> 
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Paste embeded video link from YouTube and Google Drive</label>
                                          <div class="input-group">
                                            <span class="input-group-btn">
                                                <span class="btn btn-default btn-file">
                                                    Paste Link…  
                                                </span>
                                            </span>
                                            <input   type="text" class="form-control" value="{{$question->video_link}}" name="video_link" id="video_link"> 
                                            <a class="btn btn-danger videoclear" href="javascript:void(0)">Clear</a>
                                        </div> 
                                            <iframe src="{{$question->video_link}}"   width="470" height="340" class="youtub-url"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen > </iframe>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script type="text/javascript"> 
    tinymce.init({
        selector: 'textarea.tinymce-editor',
        height: 300,
        mobile: {
            menubar: true
        },
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount', 'image'
        ],
        external_plugins: {
            tiny_mce_wiris: 'https://www.wiris.net/demo/plugins/tiny_mce/plugin.js'
        },
        toolbar: 'tiny_mce_wiris_formulaEditor | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat',
        content_css: "{{url('backend/assets/codepen.min.css')}}"
    });
</script>
<script>
    $(document).ready(function() {

        $(document).on('change', '.btn-file :file', function() {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function(event, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = label;

            if (input.length) {
                input.val(log);
            } else {
                if (log) alert(log);
            }

        });

        function readURL(input) { 
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
            $("#firstdiv").hide();
            $("#seconddiv").show(); 
            $(".customimage").show();
            $(".customvideo").hide();
        }

        $("#imgInp").change(function() {
            readURL(this);
        });

        $(".clear").click(function() {
            $('.img-upload').attr('src', '');
            $('.img-upload').attr('alt', 'Please Upload Image File');
            $('#urlname').val('');
            $(".customimage").hide(); 
            $("#firstdiv").show();
            $("#seconddiv").hide();
        });
    
    });
   // $(".videoclear").click(function(){
 
    //         $('#video_link').val('');
    //         $('#youtub-url').val('');
    //         $('.youtub-url').attr('src', '');
    //         $(".customvideo").hide(); 
    //         $("#firstdiv").show();
    //         $("#seconddiv").hide();
    // });
 /*
   $("#video_link").change(function() {
           var youtubeurl = $("#video_link").val();
            $('.youtub-url').attr('src', youtubeurl);
              $("#youtub-url").val(youtubeurl);
            $(".customvideo").show();
            $(".customimage").hide();
            $("#firstdiv").hide();
            $("#seconddiv").show(); 
   });
   */
</script>
<script>
    $(document).ready(function () {
        // Function to update iframe with embedded link
        function updateIframe(link) {
            // Check if the link is from YouTube Shorts
            if (link.includes("youtube.com/shorts")) {
                var videoIdMatch = link.match(/youtube\.com\/shorts\/([^/?]+)/);
                if (videoIdMatch && videoIdMatch[1]) {
                    var videoId = videoIdMatch[1];
                    $(".youtub-url").attr("src", "https://www.youtube.com/embed/" + videoId);
                    $("#video_links").val("https://www.youtube.com/embed/" + videoId);
                }
            }
            // Check if the link is from YouTube
            else if (link.includes("youtube.com") || link.includes("youtu.be")) {
                var videoIdMatch = link.match(/[?&]v=([^&/]+)/) || link.match(/youtu\.be\/([^&/]+)/);
                if (videoIdMatch && videoIdMatch[1]) {
                    var videoId = videoIdMatch[1];
                    $(".youtub-url").attr("src", "https://www.youtube.com/embed/" + videoId);
                    $("#video_links").val("https://www.youtube.com/embed/" + videoId);
                }
            }
            // Check if the link is from Google Drive
            else if (link.includes("drive.google.com")) {
                var fileIdMatch = link.match(/\/d\/([^/]+)/);
                if (fileIdMatch && fileIdMatch[1]) {
                    var fileId = fileIdMatch[1];
                    $(".youtub-url").attr("src", "https://drive.google.com/file/d/" + fileId + "/preview");
                    
                    $("#video_links").val( "https://drive.google.com/file/d/" + fileId + "/preview");
                }
            }
        }

        // Event listener for input field change
          // Event listener for input field change
          $("#video_link").on("input", function () {
            var videoLink = $(this).val();
            $(".youtub-url").attr("src", "");
            updateIframe(videoLink); 
            $(".customvideo").show();
            $(".customimage").hide();
            $("#firstdiv").hide();
            $("#seconddiv").show(); 
        });

        // Event listener for Clear button
        $(".videoclear").on("click", function () {
           
            $('#video_link').val('');
            $('#youtub-url').val('');
            $("#video_links").val("");
            $('.youtub-url').attr('src', '');
            $(".customvideo").hide(); 
            $("#firstdiv").show();
            $("#seconddiv").hide();
        });
    });
</script>

<script>
    $("#question_type").change(function () { 

        if($(this).val() == 1){
            $("#mcqs").html('');
            $("#correctchoices").html('');  
            $("#truefalses").html('');
            $("#identifications").append(' <div class="col-md-12 form-group">\
                                    <label for="">Correct answer</label>\
                                    <textarea type="text" class="form-control round" id="identification" name="identification" placeholder="Correct answer here..." required></textarea>\
                                </div>');

        }
        else if ($(this).val() == 2){
            $("#truefalses").html('');
            $("#identifications").html('');
            $("#mcqs").append('<div class="col-md-3"><label>Choice 1</label><input name="mcq[]" type="text" class="form-control round"></div>\
                                <div class="col-md-3"><label>Choice 2</label><input name="mcq[]" type="text" class="form-control round"></div>\
                                <div class="col-md-3"><label>Choice 3</label><input name="mcq[]" type="text" class="form-control round"></div>\
                                <div class="col-md-3"><label>Choice 4</label><input name="mcq[]" type="text" class="form-control round"></div>');
            $("#correctchoices").append(' <div class="col-md-12">\
                                    <label for="">Correct choice</label>\
                                    <select  name="correctchoice" class="form-control round" required>\
                                        <option value="">--Select Correct choice--</option>\
                                        <option value="0">Choice 1</option>\
                                        <option value="1">Choice 2</option>\
                                        <option value="2">Choice 3</option>\
                                        <option value="3">Choice 4</option>\
                                    </select>\
                                </div>');
        }else if($(this).val() == 3){
            $("#mcqs").html('');
            $("#correctchoices").html('');  
            $("#truefalses").html('');
            $("#identifications").html('');
            $("#truefalses").append('<div class="col-md-12">\
                                    <label for="">Correct answer</label>\
                                    <select name="truefalse" id="truefalse" class="form-control round" required>\
                                        <option value="">--Select correct answer--</option>\
                                        <option value="1">True</option>\
                                        <option value="0">False</option>\
                                    </select>\
                                </div>');
        }
    });
</script>
<!-- <script src="{{asset('backend/css/lib/mathquill.min.js')}}"></script>
<script src="{{asset('backend/css/lib/matheditor.js')}}"></script>
<script type="text/javascript">
  // me.removeButtons(['fraction']);
  // me.setTemplate('floating-toolbar');
  
  function mathEquationModal(){

    var myEditor = new MathEditor('answer');
    myEditor.buttons = ["fraction","mix_fraction","square_root","cube_root","root",'superscript','subscript','multiplication','division','plus_minus','pi','degree','not_equal','greater_equal','less_equal','greater_than','less_than','angle','parallel_to','perpendicular','triangle','parallelogram','round_brackets'];
    myEditor.setTemplate('keypad'); 
    myEditor.styleMe({
        width: 769,
        height: 100,
        textarea_background: "#FFFFFF",
        textarea_foreground: "#000000",
        textarea_border: "#000000",
        toolbar_background: "#FFFFFF",
        toolbar_foreground: "#000000",
        toolbar_border: "#000000",
        button_background: "#FFFFFF",
        button_border: "#000000",
    });
    $("#mathtool").modal('show');
  }
  function insertValue(){
    
  }
</script> -->
@endsection
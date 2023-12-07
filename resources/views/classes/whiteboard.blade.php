@extends('layouts.admin')
@section('css')
<link href="{{ asset('public/whiteboard/whiteboard.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro@4cac1a6/css/all.css" rel="stylesheet" type="text/css" /> 
<style>
    .tools button[tool] {
        color: black;
        /* letter-spacing: -26px; */
        display: inline-block;
        height: 30px;
        font-size: 14px;
    }
</style>
<style>
    #whiteboard {
        margin-left: 12px;
    }

    #teacher-whiteboards {
        text-align: center;
        background: antiquewhite;
    }

    .offclass {
        background: antiquewhite;
    }

    .card-img-top {
        height: 160px;
    }

    .text-default {
        color: #0B9688 !important;
    }

    .btn-floating i {
        font-size: 1.25rem;
        line-height: 47px;
        display: inline-block;
        width: inherit;
        color: #fff;
        text-align: center;
    }

    .btn-floating {
        position: relative;
        z-index: 1;
        display: inline-block;
        padding: 0;
        margin: 10px;
        /* overflow: hidden; */
        vertical-align: middle;
        cursor: pointer;
        border-radius: 50%;
        box-shadow: 0 5px 11px 0 rgb(0 0 0 / 18%), 0 4px 15px 0 rgb(0 0 0 / 15%);
        -webkit-transition: all .2s ease-in-out;
        transition: all .2s ease-in-out;
        width: 47px;
        height: 47px;
    }

    .waves-effect {
        position: relative;
        overflow: hidden;
        cursor: pointer;
        user-select: none;
    }
    .ML__virtual-keyboard-toggle.is-visible {
    fill: currentColor;
    align-items: center;
    align-self: center;
    background: transparent;
    border: 1px solid transparent;
    border-radius: 8px;
    box-sizing: border-box;
    color: var(--primary,hsl(var(--hue,212),40%,50%));
    cursor: pointer;
    display: flex;
    flex-direction: column;
    flex-shrink: 0;
    height: 34px;
    justify-content: center;
    margin-right: 4px;
    padding: 0;
    transition: background .2s cubic-bezier(.64,.09,.08,1);
    width: 34px;
}
</style>
@endsection

@section('title', $lecture->title)
@section('start_time', $start_time)
@section('end_time', $end_time)
@section('start_button')
@if($lecture->state == 1)
<button class="btn btn-primary @if($lecture->state == 1) btn-danger @endif my-2 my-sm-0 " id="start_class" type="button">End Class </button>
@elseif($lecture->state == 0)
<button class="btn  @if($lecture->state == 0) btn-primary @endif my-2 my-sm-0 " id="start_class" type="button">Start
    Class </button>
@endif
<a class="btn btn-primary  my-2 my-sm-0 " id="whiteboard" href="{{url('class/lecture',$lecture->id)}}">Back To Lecture </a>

@endsection
@section('content')
<div class="app-content content pt-2 pb-2 p-2" data-auth-user="{{Auth::id()}}" data-auth-role="{{Auth::user()->role_id}}">

    @if(Auth::user()->role_id == 2)
    <a class="btn btn-block collapsed btn-success my-2" id="toggle-teacher-button" data-toggle="collapse" href="#teacher-whiteboards">
        <i class="fas fa-chalkboard-teacher fa-fw"></i> Click To View Teacher Whiteboard
    </a>
    <div class="collapse" id="teacher-whiteboards">
        <img src="{{$whiteboard->data_image}}" id="teacherwhiteboard-{{$lecture->id}}">
    </div>
    @endif
    @if(Auth::user()->role_id == 1)
    @php $usertype = "admin"; @endphp
    @elseif(Auth::user()->role_id == 2)
    @php $usertype = "student"; @endphp
    @elseif(Auth::user()->role_id == 3)
    @php $usertype = "teacher"; @endphp
    @endif
    @if($lecture->state == 1)
    <div class="card">
        <div class="card-header  bg-primary">
            <h4 class="text-white">{{$lecture->title}}</h4>
        </div>
    </div>
    <zwibbler showToolbar="false" z-init="filename='drawing'" persistent="true" pageView="true" pageInflation="1" defaultPaperSize="none" defaultBrushWidth="2" z-controller="whiteController" defaultFontSize="50" defaultZoom="page" outsidePageColour="#ebebeb" setFocus="true" persistent="true" multilineText="true" class="flex-container" background="white" style="width: 100%;height: 1140px;" showColourPanel="true">
        <div class="row px-0 flex-item">
            <div z-init="userType='{{$usertype}}-{{$lecture->id}}-{{Auth::user()->id}}'" class="row px-0 flex-item">
                <div class="tools col-12 card mx-0 px-0" z-init="library=0">

                    <div z-init="hasFeedback=0" style="    padding-left: 12px;">

                        <div z-init="smoothRefresh=0"></div>
                        <button tool class="btn" z-on:click="usePickTool()" title="Select" z-class="{selected:getCurrentTool()=='pick'}" data-sentry-click="Select Tool">
                            <i class="fas fa-mouse-pointer"></i>
                        </button>
                        <button tool class="btn" z-on:click="useBrushTool()" title="Draw" z-class="{selected:getCurrentTool()=='brush'}" data-sentry-click="Draw Tool">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button toolsettings class="btn btn-warning px-3" z-show-popup="toolSettingsPopup" data-sentry-click="Tool Settings Modal Button"><i class="fas fa-pencil-paintbrush"></i> <i class="fas fa-cog"></i></button>

                        <button tool class="btn" title="Draw Tools" z-show-popup="menu-draw-tools" z-class="{selected:(getCurrentTool()=='line' || getCurrentTool()=='arrow' || getCurrentTool()=='shapebrush')}" data-sentry-click="Draw Tools Popup"><i class="fas fa-pencil-ruler"></i></button>
                        <div z-popup="menu-draw-tools" z-show-position="bl tl" z-click-dismiss>
                            <button class="btn btn-sm btn-block" z-click="useLineTool()" title="Line Tool" data-sentry-click="Line Tool"><i class="fas fa-draw-polygon"></i> Line Tool</button>
                            <button class="btn btn-sm btn-block" z-click="useArrowTool()" title="Arrow Tool" data-sentry-click="Arrow Tool"><i class="fas fa-long-arrow-right"></i> Arrow Tool</button>
                            <button class="btn btn-sm btn-block" z-click="useShapeBrushTool()" title="Shape Brush" data-sentry-click="Shape Brush Tool"><i class="fas fa-shapes"></i> Shape Brush</button>
                        </div>
                        <button tool class="btn" z-click="useRectangleTool()" title="Rectangle" data-sentry-click="Rectangle Tool" z-class="{selected:getCurrentTool()=='rectangle'}">
                            <i class="fas fa-square"></i>
                        </button>
                        <button tool class="btn" z-click="useCircleTool()" title="Circle" data-sentry-click="Circle Tool" z-class="{selected:getCurrentTool()=='circle'}">
                            <i class="fas fa-circle"></i>
                        </button>
                        <button tool class="btn" title="Polygon" z-show-popup="menu-draw-polygon" z-class="{selected:getCurrentTool()=='polygon'}" data-sentry-click="Polygon Tool"><i class="fas fa-hexagon"></i></button>
                        <div z-popup="menu-draw-polygon" z-show-position="bl tl" z-click-dismiss>
                            Insert polygon:
                            <button class="btn btn-sm btn-block" z-click="usePolygonTool(3)" data-sentry-click="Polygon Tool, 3 corners">3 corners</button>
                            <button class="btn btn-sm btn-block" z-click="usePolygonTool(4)" data-sentry-click="Polygon Tool, 4 corners">4 corners</button>
                            <button class="btn btn-sm btn-block" z-click="usePolygonTool(5)" data-sentry-click="Polygon Tool, 5 corners">5 corners</button>
                            <button class="btn btn-sm btn-block" z-click="usePolygonTool(6)" data-sentry-click="Polygon Tool, 6 corners">6 corners</button>
                            <button class="btn btn-sm btn-block" z-click="usePolygonTool(7)" data-sentry-click="Polygon Tool, 7 corners">7 corners</button>
                            <button class="btn btn-sm btn-block" z-click="usePolygonTool(8)" data-sentry-click="Polygon Tool, 8 corners">8 corners</button>
                            <button class="btn btn-sm btn-block" z-click="usePolygonTool(9)" data-sentry-click="Polygon Tool, 9 corners">9 corners</button>
                            <button class="btn btn-sm btn-block" z-click="usePolygonTool(10)" data-sentry-click="Polygon Tool, 10 corners">10 corners</button>
                            <button class="btn btn-sm btn-block" z-click="usePolygonTool(11)" data-sentry-click="Polygon Tool, 11 corners">11 corners</button>
                            <button class="btn btn-sm btn-block" z-click="usePolygonTool(12)" data-sentry-click="Polygon Tool, 12 corners">12 corners</button>
                        </div>
                        <button tool class="btn" z-click="useTextTool()" title="Text" data-sentry-click="Text Tool" z-class="{selected:getCurrentTool()=='text'}">
                            <i class="fas fa-font"></i>
                        </button>
                        <button tool class="btn" z-click="insertImage()" title="Insert image" data-sentry-click="Insert Image Button">
                            <i class="fas fa-image"></i>
                        </button>
                        <!-- <button tool class="btn" onclick="$('#modal-license').modal('show')" title="Insert PDF" data-sentry-click="Insert PDF Button, license modal">
                            <i class="fas fa-file-pdf"></i>
                        </button> -->
                        <button tool class="btn" z-click="cut()" title="Cut" data-sentry-click="Cut Button">
                            <i class="fas fa-cut"></i>
                        </button>
                        <button tool class="btn" z-click="copy()" title="Copy" data-sentry-click="Copy Button">
                            <i class="fas fa-copy"></i>
                        </button>
                        <button tool class="btn" z-click="paste()" title="Paste" data-sentry-click="Paste Button">
                            <i class="fas fa-paste"></i>
                        </button>
                        <button tool class="btn" z-click="undo()" z-disabled="!canUndo()" title="Undo" data-sentry-click="Undo Button">
                            <i class="fas fa-undo"></i>
                        </button>
                        <button tool class="btn" z-click="redo()" z-disabled="!canRedo()" title="Redo" data-sentry-click="Redo Button">
                            <i class="fas fa-redo"></i>
                        </button>
                        <button tool class="btn" z-click="zoomIn()" title="Zoom In" data-sentry-click="Zoom In Button">
                            <i class="fas fa-search-plus"></i>
                        </button>
                        <button tool class="btn" z-click="setZoom('page')" title="Reset Zoom" data-sentry-click="Reset Zoom Button">
                            <i class="fas fa-compress-arrows-alt"></i>
                        </button>
                        <button tool class="btn" z-click="usePanTool()" title="Pan Tool" data-sentry-click="Pan Tool Button" z-class="{selected:getCurrentTool()=='pan'}">
                            <i class="fas fa-arrows-alt"></i>
                        </button>
                        <button tool class="btn" z-click="zoomOut()" title="Zoom Out" data-sentry-click="Zoom Out Button">
                            <i class="fas fa-search-minus"></i>
                        </button>
                        <button tool class="btn" z-click="Download" z-show-popup="menu-save" title="Download" data-sentry-click="Download Modal Button"><i class="fas fa-download"></i></button>
                        <button tool class="btn text-danger" title="Delete Object" data-sentry-click="Delete Object Button" z-disabled="getSelectedNodes().length == 0" z-click="deleteNodes()"><i class="fas fa-trash-alt"></i></button>
                        <button tool class="btn" title="Bring To Front" data-sentry-click="Bring To Front Button" z-click="bringToFront()" z-disabled="getSelectedNodes().length == 0">
                            <i class="fad fa-bring-front"></i>
                        </button>
                        <button tool class="btn" title="Send to Back" data-sentry-click="Send To Back Button" z-click="sendToBack()" z-disabled="getSelectedNodes().length == 0">
                            <i class="fad fa-send-back"></i>
                        </button>
                        <button tool class="btn" title="Erase" data-sentry-click="Erase Tool" z-class="{selected:getCurrentTool()=='brush'}" z-on:click="myerase()">
                            <i class="fas fa-eraser"></i>
                        </button>
                       
                        <button tool class="btn" title="Insert Small Grid" data-sentry-click="Insert Small Grid Button" z-click="setConfig('backgroundImage','{{asset('public/whiteboard/images/grid_1200x800.png')}}')"><i class="fal fa-th"></i></button>
                        <button tool class="btn" title="Insert Large Grid" data-sentry-click="Insert Large Grid Button" z-click="setConfig('backgroundImage','{{asset('public/whiteboard/images/grid_1200x800_large.png')}}')"><i class="fal fa-th-large"></i></button>
                        <button tool class="btn" title="Insert Music Sheet" data-sentry-click="Insert Music Sheet Button" z-click="setConfig('backgroundImage','{{asset('public/whiteboard/images/music_new_1200x800.png')}}')"><i class="fas fa-music"></i></button>
                        <button tool="" title="Insert Math" data-sentry-click="Insert Math Button" z-custom-tool="math" class="btn waves-effect waves-light"><i class="fas fa-square-root-alt"></i></button>
                        <!-- <button tool class="btn" title="Erase" data-sentry-click="Erase Tool" z-class="{selected:getCurrentTool()=='brush'}" z-on:click="clearwhiteboard()" style="width: 7%;">
                            <i class="fas fa-eraser"> Clear Page</i> 
                        </button> -->
                        <!-- <button tooltext class="btn text-default" title="Library" data-sentry-click="Library Button" z-custom-tool="libraryButton"><i class="fas fa-folder-download" style="font-size: 120%;"></i> Library</button>
                                    <button tooltext class="btn text-default" title="Assignments" data-sentry-click="Assignments Button" z-custom-tool="assignmentsTeacherButton"><i class="fas fa-user-check" style="font-size: 120%;"></i> Assignments</button>
                                    <button toolsettings class="btn btn-default float-right px-3" title="Push / Assign" data-sentry-click="Push/Assign Button" z-custom-tool="pushAssignButton"><i class="fas fa-copy"></i> Push / Assign</button> -->
                    </div>
                    <div z-popup="toolSettingsPopup" z-show-position="bl tl">
                        <div z-has="fontName">
                            <b>Font</b><br>
                            <select z-property="fontName">
                                <option>Arial</option>
                                <option value="Comic Sans MS">Comic Sans</option>
                                <option>Courier New</option>
                                <option>Times New Roman</option>
                            </select>
                        </div>
                        <div z-has="fontSize">
                            <b>Font size</b><br>
                            <input z-property="fontSize" type="range" min="8" max="100" step="2">
                        </div>
                        <div z-has="fillStyle">
                            <b>Colours</b><br>
                            <div class="colour-picker" z-has="fillStyle">
                                <div swatch z-property="fillStyle" z-colour></div>
                                Fill style
                            </div>
                            <div class="colour-picker" z-has="strokeStyle">
                                <div swatch z-property="strokeStyle" z-colour></div>
                                Outline
                            </div>
                            <div class="colour-picker" z-has="background">
                                <div swatch z-property="background" z-colour></div>
                                Background
                            </div>
                        </div>
                        <div z-has="arrowSize">
                            <b>Arrows</b></br>
                            <button class="btn btn-sm option" z-property="arrowSize" z-value="0">None</button>
                            <button class="btn btn-sm option" z-property="arrowSize" z-value="10">Small</button>
                            <button class="btn btn-sm option" z-property="arrowSize" z-value="15">Large</button>
                            <hr>
                            <button class="btn btn-sm option" z-property="arrowStyle" z-value="solid">Solid</button>
                            <button class="btn btn-sm option" z-property="arrowStyle" z-value="open">Open</button>
                        </div>
                        <div z-has="lineWidth">
                            <b>Line width</b><br>
                            <input z-property="lineWidth" type="range" min="1" max="50" step="1">
                        </div>
                        <div z-has="dashes">
                            <b>Line style</b><br>
                            <button class="btn btn-sm option" z-property="dashes" z-value="">Solid</button>
                            <button class="btn btn-sm option" z-property="dashes" z-value="3,3">Dots</button>
                            <button class="btn btn-sm option" z-property="dashes" z-value="8,2">Dashes</button>
                        </div>
                        <div z-has="opacity">
                            <b>Opacity</b><br>
                            <input z-property="opacity" type="range" min="0.1" max="1.0" step="0.05">
                        </div>
                    </div>
                    <div z-popup="menu-save">
                        <button class="btn" data-sentry-click="Download Modal, PNG Button" z-click="download('png', 'drawing.png')">PNG</button>
                        <button class="btn" data-sentry-click="Download Modal, JPG Button" z-click="download('jpg', 'drawing.jpg')">JPG</button>
                        <button class="btn" data-sentry-click="Download Modal, SVG Button" z-click="download('svg', 'drawing.svg')">SVG</button>
                        <button class="btn" data-sentry-click="Download Modal, PDF Button" z-click="download('pdf', 'drawing.pdf')">PDF</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row flex-item">
            <div class="col-12 px-0 mx-0">
                <div z-canvas style="width: 100%; height: 100%;"></div>
            </div>
        </div>
        <div class="row flex-item card p-0">
            <!-- <div class="pages col-12 px-0 mx-0">
                            <button class="btn btn-sm" title="Insert page" z-click="addPage()" data-sentry-click="Insert Page Button"><i class="fas fa-plus"></i></button>
                            <button class="btn btn-sm" title="Delete page" z-click="deletePageCustom()" data-sentry-click="Delete Page Button"><i class="fas fa-minus"></i></button>
                            <div z-for="mypage in getPageCount()">
                                <div z-page="mypage" z-height="70" class="page" z-class="{selected: mypage==getCurrentPage()}" z-click="setCurrentPage(mypage)" data-sentry-click="Set Current Page Button"></div>
                               
                            </div>
                            
                        </div> -->
            <!-- <div class="pages  px-0 mx-0">
                <button class="btn btn-sm" title="Insert page" title="Insert page" z-click="insertPage()"><i class="fas fa-plus"></i></button>
                <button class="btn btn-sm" title="Delete page" title="Delete page" z-click="deletePage()"><i class="fas fa-minus"></i></button>
                <div z-for="mypage in getPageCount()">
                    <div z-page="mypage" z-height="70" class="page" z-class="{selected: mypage==getCurrentPage()}" z-click="setCurrentPage(mypage)"></div>
                </div>
            </div> -->
        </div>
    </zwibbler>
    @else
    <div class="card">
        <div class="card-header  bg-primary">
            <h4 class="text-white">{{$lecture->title}}</h4>
        </div>
        <div class="card-body pt-0">
            <div class="row">
                <div class="col-12 text-center offclass">
                    <img src="{{$whiteboard->data_image}}" id="teacherwhiteboard-{{$lecture->id}}">
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 3)
    <div class="row" id="users-lists-{{$lecture->id}}">
        @foreach($whiteboard_lectures as $student)
        <div class="col-6 col-md-4 col-lg-3 p-0 m-0" id="studentcard-{{$lecture->id}}-{{$student->user_id}}">
            <div class="card m-1" onclick="openStudentModal('{{$student->username}}','{{$student->data_image}}','sd-{{$lecture->id}}-{{$student->user_id}}')">
                <div class="view overlay">
                    <a href="#"><img src="{{$student->data_image}}" hash="" alt="{{$student->username}}" class="card-img-top  student_whiteboard sd-{{$lecture->id}}-{{$student->user_id}} main_whiteboard">
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>
                <div class="card-body p-0 name_display">
                    <p class="card-text text-center">
                        <i class="fas fa-user"></i>
                        <span>{{$student->username}}</span>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-notify modal-warning" role="document" id="updatemodal">

    </div>
</div>
<div class="modal fade" id="mathModal" tabindex="-1" aria-labelledby="mathModalLabel" aria-hidden="true" node-reference="">
    <div class="modal-dialog modal-lg modal-notify modal-warning">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="heading lead modal-title" id="mathModalLabel"><i class="fad fa-fw fa-square-root-alt"></i> Math Tools</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <!-- Modal Body-->
            <div class="modal-body p-3 m-0" id="mathModalContent">
                <!-- Math Tool Buttons-->
                <div id="math-btn-group" class="container p-0 m-0" aria-label="Math Options">
                    <div class="row text-center p-0 m-0">
                        <div class="col-md-4 p-2 m-0">
                            <button type="button" class="math-tool-loader btn btn-default btn-lg w-100 m-0" id="equation-btn" href="javascript:voide(0)" title="Equation" data-sentry-click="Math Modal, Equation Button">
                                <i class="fas fa-square-root-alt math-icon fa-3x" style="pointer-events: none"></i>
                            </button>
                            <p>Equation</p>
                        </div>
                        <div class="col-md-4 p-2 m-0">
                            <button type="button" class="math-tool-loader btn btn-default btn-lg w-100 m-0" id="graph-btn" href="#kaavio-tool" title="Graphs" data-sentry-click="Math Modal, Graphs Button">
                                <i class="fas fa-wave-sine math-icon fa-3x" style="pointer-events: none"></i>
                            </button>
                            <p>Graphs</p>
                        </div>
                        <div class="col-md-4 p-2 m-0">
                            <button type="button" class="math-tool-loader btn btn-default btn-lg w-100 m-0" id="angle-btn" href="#angle-tool" title="Angle" data-sentry-click="Math Modal, Angle Button">
                                <i class="fas fa-less-than math-icon fa-3x" style="pointer-events: none"></i>
                            </button>
                            <p>Angle</p>
                        </div>
                    </div>
                    <div class="row text-center p-0 m-0">
                        <!-- <div class="col-md-4 p-2 m-0">
                            <button type="button" class="math-tool-loader btn btn-default btn-lg w-100 m-0" id="boxes-btn" href="#boxes-tool" title="Boxes" hide-save-button data-sentry-click="Math Modal, Boxes Button">
                                <i class="fas fa-th math-icon fa-3x" style="pointer-events: none"></i>
                            </button>
                            <p>Boxes</p>
                        </div>
                        <div class="col-md-4 p-2 m-0">
                            <button type="button" class="math-tool-loader btn btn-default btn-lg w-100 m-0" onclick="replaceMathTool('piechart')" id="piechart-btn" href="javascript:void(0)" title="Pie Chart" data-sentry-click="Math Modal, Pie Chart Button">
                                <i class="fas fa-chart-pie math-icon fa-3x" style="pointer-events: none"></i>
                            </button>
                            <p>Pie Chart</p>
                        </div> -->
                        <div class="col-md-4 p-2 m-0">
                            <button type="button" class="btn btn-default btn-lg w-100 m-0" id="ruler-btn" title="Ruler" data-sentry-click="Math Modal, Ruler Button">
                                <i class="fas fa-ruler math-icon fa-3x" style="pointer-events: none"></i>
                            </button>
                            <p>Ruler</p>
                        </div>
                        <div class="col-md-4 p-2 m-0">
                            <button type="button" class="btn btn-default btn-lg w-100 m-0" id="protractor-btn" title="Protractor" data-sentry-click="Math Modal, Protractor Button">
                                <i class="fas fa-ruler-triangle math-icon fa-3x" style="pointer-events: none"></i>
                            </button>
                            <p>Protractor</p>
                        </div>
                    </div>
                    <div class="row text-center p-0 m-0">
                        
                    </div>
                </div>
                <!-- Math Tools-->
                <div class="container p-2" id="math-content" style="display: none">
                    <div class="math-content-tool" id="equation-tool">
                        <!-- <ul class="nav nav-tabs nav-justified md-tabs default" id="equation-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="equation-latex-tab-textarea" data-toggle="tab" href="#equation-editor-mathfield" role="tab" aria-controls="home-just" aria-selected="true"><i class="fad fa-square-root-alt"></i> Editor</a>
                            </li> 
                        </ul> -->
                        <div class="tab-content  pt-5" id="editor-content-just">
                            <div class="tab-pane fade show active" id="equation-editor-mathfield" role="tabpanel" aria-labelledby="editor-tab-just">
                                <div class="d-flex justify-content-between">
                                    <h3>Enter math:</h3>
                                    <div class="help-tip">
                                        <p>
                                            Enter math into the input field below or press the keyboard
                                            icon to open the virtual math keyboard. LaTeX code can be
                                            entered directly into the input field.
                                        </p>
                                    </div>
                                </div>
                                <math-field class="p-1 fa-2x border rounded" id="mathlive-equation-editor" keypress-sound="none" plonk-sound="none">f(x)=e^x</math-field>
                            </div> 
                        </div>
                    </div>
                    <!-- <div class="math-content-tool" id="kaavio-tool">
                        <div class="m-0 p-0" id="kaavio-tool-container" style="height: 450px; width: 100%"></div>
                    </div> -->
                    <!-- <div class="math-content-tool" id="boxes-tool">
                        <div class="text-center mb-4">
                            <div>
                                <canvas id="boxes-canvas" style="width: fit-content; max-width: 100%; height: fit-content;">Your browser does not support the canvas tag.</canvas>
                            </div>
                            <b class="p-2" id="boxes-size-text">Size: 0 x 0</b>
                        </div>
                        <div class="
                                d-flex
                                flex-row flex-wrap
                                justify-content-center
                                align-items-start
                                rounded
                                z-depth-1
                            " style="gap: 15px" id="boxes-settings">
                            <div class="m-3 flex-fill" style="max-width: 100px;">
                                <b>Fill style</b><br />
                                <input type="color" class="boxes-color-picker w-100" id="boxes-color-picker-fill" list="boxes-fill-colors" value="#fbb244" style="height: 40px" />
                                <datalist id="boxes-fill-colors">
                                    <option value="#fbb244"></option>
                                    <option value="#0B9688"></option>
                                    <option value="#ff2222"></option>
                                    <option value="#ff00ff"></option>
                                    <option value="#5555ff"></option>
                                    <option value="#00dddd"></option>
                                    <option value="#00ff00"></option>
                                    <option value="#fce303"></option>
                                    <option value="#888888"></option>
                                    <option value="#111111"></option>
                                </datalist>
                            </div>
                            <div class="m-3 flex-fill" style="max-width: 100px;">
                                <b>Outline</b><br />
                                <input type="color" class="boxes-color-picker w-100" id="boxes-color-picker-outline" list="boxes-outline-colors" value="#d99022" style="height: 40px" />
                                <datalist id="boxes-outline-colors">
                                    <option value="#d99022"></option>
                                    <option value="#097466"></option>
                                    <option value="#cc0000"></option>
                                    <option value="#cc00cc"></option>
                                    <option value="#0000dd"></option>
                                    <option value="#00bbbb"></option>
                                    <option value="#00dd00"></option>
                                    <option value="#cfba00"></option>
                                    <option value="#444444"></option>
                                    <option value="#111111"></option>
                                </datalist>
                            </div>
                            <div class="m-3 flex-fill" style="max-width: 100px">
                                <b>Line width</b><br />
                                <input class="w-100" type="range" min="0" max="10" step="1" value="0" id="boxes-outline-thickness" title="Outline thickness" />
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="math-content-tool" id="pie-chart-tool">
                        <div class="text-center h-100 mb-4">
                            <div class="m-0">
                                <canvas id="pie-chart-canvas" style="width: fit-content; max-width: 100%; height: fit-content">
                                    Your browser does not support the canvas tag.
                                </canvas>
                            </div>
                            <div class="
                                    flex-fill
                                    d-flex
                                    h-100
                                    align-items-end
                                    justify-content-center
                                    m-2
                                    ">
                                <div>
                                    <input type="number" value="2" min="1" max="1000" style="width: 60px; height: 27px" id="pie-chart-dividee" />
                                    <b>/</b>
                                    <input type="number" value="3" min="1" max="1000" style="width: 60px; height: 27px" id="pie-chart-divisor" />
                                </div>
                            </div>
                        </div>
                        <div class="
                                d-flex
                                flex-row flex-wrap
                                justify-content-center
                                align-items-start
                                rounded
                                z-depth-1
                            " style="gap: 15px" id="pie-chart-settings">
                            <div class="m-3 flex-fill" style="max-width: 100px;">
                                <b>Fill style</b><br />
                                <input type="color" class="pie-chart-color-picker w-100" id="pie-chart-color-picker-fill" list="pie-chart-fill-colors" value="#fbb244" style="height: 40px" />
                                <datalist id="pie-chart-fill-colors">
                                    <option value="#fbb244"></option>
                                    <option value="#0B9688"></option>
                                    <option value="#ff2222"></option>
                                    <option value="#ff00ff"></option>
                                    <option value="#5555ff"></option>
                                    <option value="#00dddd"></option>
                                    <option value="#00ff00"></option>
                                    <option value="#fce303"></option>
                                    <option value="#888888"></option>
                                    <option value="#111111"></option>
                                </datalist>
                            </div>
                            <div class="m-3 flex-fill" style="max-width: 100px;">
                                <b>Outline</b><br />
                                <input type="color" class="pie-chart-color-picker w-100" id="pie-chart-color-picker-outline" list="pie-chart-outline-colors" value="#ffffff" style="height: 40px" />
                                <datalist id="pie-chart-outline-colors">
                                    <option value="#FFFFFF"></option>
                                    <option value="#097466"></option>
                                    <option value="#cc0000"></option>
                                    <option value="#cc00cc"></option>
                                    <option value="#0000dd"></option>
                                    <option value="#00bbbb"></option>
                                    <option value="#00dd00"></option>
                                    <option value="#cfba00"></option>
                                    <option value="#444444"></option>
                                    <option value="#111111"></option>
                                </datalist>
                            </div>
                            <div class="m-3 flex-fill" style="max-width: 100px">
                                <b>Line width</b><br />
                                <input class="w-100" type="range" min="0" max="10" step="1" value="5" id="pie-chart-outline-thickness" title="Outline thickness" />
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="math-content-tool" id="angle-tool">
                        <div class="text-center mb-4">
                            <canvas id="angle-canvas" style="width: fit-content; max-width: 100%; height: fit-content">
                                Your browser does not support the canvas tag.
                            </canvas>
                        </div>
                        <div class="
                                d-flex
                                flex-row flex-wrap
                                justify-content-center
                                rounded
                                z-depth-1
                            " style="gap: 15px;">
                            <div class="m-3 flex-fill" style="max-width: 150px; min-width: 120px;">
                                <b>Angle</b><br />
                                <div class="row m-0 p-0">
                                    <input class="col m-0 p-0" type="number" value="45" min="0" max="360" style="height: 40px" id="angle-value" />
                                    <button class="col btn btn-block btn-sm btn-default m-0 px-1" data-type="degrees" id="angle-type" style="height: 40px">degrees</button>
                                </div>
                            </div>
                            <div class="m-3 flex-fill" style="max-width: 100px;">
                                <b>Lines</b><br />
                                <input class="w-100" type="number" value="0" min="0" max="10" style="height: 40px" id="angle-crosses" />
                            </div>
                            <div class="m-3 flex-fill" style="max-width: 100px">
                                <b>Radius</b><br />
                                <input class="w-100 align-self-center" type="range" min="0" max="0.95" step="0.01" value="0.5" id="angle-radius" />
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <!-- Math Footer-->
            <div class="modal-footer text-left">
                <button type="button" id="mathModal-back-btn" class="btn btn-primary mr-auto grey-text" data-sentry-click="Math Modal, Back Button">
                    <i class="fas fa-chevron-left grey-text"></i>
                    Back
                </button>
                <button type="button" class="btn btn-primary mathModal-close-btn grey-text" data-mdb-dismiss="modal" data-sentry-click="Math Modal, Close Button">
                    <i class="fas fa-times grey-text"></i>
                    Close
                </button>
                <button type="button" id="mathModal-save-btn" data-save-type="#equation-tool" class="btn btn-default" style="display: none" data-sentry-click="Math Modal, Equation Save Button">
                    <i class="fas fa-plus"></i>
                    Insert
                </button>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{asset('public/whiteboard/js/mathlive.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('public/whiteboard/js/zwibbler2.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.2.228/build/pdf.min.js"></script>

<script async="true" src="https://cdn.jsdelivr.net/npm/mathjax@2/MathJax.js?config=AM_CHTML"> </script>

<script type="text/javascript">
    $("#equation-btn").click(function() {
        $("#math-btn-group").hide();
        $("#equation-tool").show();
        $("#math-content").show(); 
        $("#mathModal-save-btn").show();
    });
    $("#mathModal-back-btn").click(function(){
        
        $("#math-btn-group").show();
        $("#equation-tool").hide();
        $("#math-content").hide(); 
        $("#mathModal-save-btn").hide();
    });
    $('#start_class').click(function() {
        var $this = $(this);
        $this.toggleClass('btn-danger');
        if ($this.hasClass('btn-danger')) {
            $this.text('End Class');
            $(document).find('#whiteboard').show();
            var state = 1;
            lectureStateUpdate(state);
        } else if ($this.hasClass('btn-primary')) {
            var state = 0;
            $this.text('Start Class');
            $(document).find('#whiteboard').hide();
            lectureStateUpdate(state);
        }
    });


    function lectureStateUpdate(state) {
        $.ajax({
            type: "get",
            url: "{{ url('class/lecture/state/'.$lecture->id) }}",
            data: {
                state: state
            },
            success: function(data) {
                console.log(data);
            }
        });
    }

    Pusher.logToConsole = true;
    var pusher = new Pusher("{{env('PUSHER_APP_KEY')}}", {
        cluster: "{{env('PUSHER_APP_CLUSTER')}}"
    });

    var channel = pusher.subscribe("whiteboardlecture-{{$lecture->id}}");
    channel.bind("image-data", (data) => {
        if (data) {
            getWhiteBoardData(data);
        }
    });
    var i = 0;
    Zwibbler.controller("whiteController", (scope) => {
        const ctx = scope.ctx;
        var data = '<?php echo $whiteboard->whiteboard_data ?>';
        <?php if ($whiteboard->data_image) { ?>
            if (i == 0) {
                ctx.load(data);
            }
        <?php } else { ?>
            ctx.newDocument();
        <?php } ?>
        //Eraser Tool//
        scope.myerase = () => {
            ctx.useBrushTool({
                lineWidth: 20,
                strokeStyle: "erase",

                // optional: prevents the user from being able to move the erase stroke.
                layer: "my_eraser_layer"
            });
        }
         
        /**EndTool**/
        /**Save Document on Change**/
        ctx.on("document-changed", function(info) {
            if (i != 0) {
                var saved = ctx.save();
                var dataUrl = ctx.save("png");
                //save document in database 
                $.ajax({
                    url: "{{url('class/whiteboard/saved')}}",
                    type: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                        user_id: "{{Auth::user()->id}}",
                        username: "{{Auth::user()->first_name}} {{Auth::user()->last_name}}",
                        lecture_id: "{{$lecture->id}}",
                        role_id: "{{Auth::user()->role_id}}",
                        whiteboard_data: saved,
                        data_image: dataUrl,
                    },
                    dataType: "json",
                    encode: true,
                    success: function(data) {}
                });
            }

        });
        /**End**/
        
    });

    function getWhiteBoardData(data) {
        if (data.id) {
            $.ajax({
                url: "{{url('class/getWhiteboard/data')}}",
                type: "get",
                data: {
                    _token: "{{csrf_token()}}",
                    whiteboard_id: data.id,
                },
                dataType: "json",
                encode: true,
                success: function(datas) {
                    if (datas) {
                        if (datas.data.role_id == 1 || datas.data.role_id == 3) {
                            $("#teacherwhiteboard-" + datas.data.lecture_id).attr('src', datas.data.data_image);
                        } else {
                            if ($("#studentcard-" + datas.data.lecture_id + '-' + datas.data.user_id).length == 0) {
                                $("#users-lists-" + datas.data.lecture_id).append('<div class="col-6 col-md-4 col-lg-3 p-0 m-0" id="studentcard-' + datas.data.lecture_id + '-' + datas.data.user_id + '">\
                                    <div class="card m-1" onclick="openStudentModal(' + datas.data.username + ',' + datas.data.data_image + ',sd-' + datas.data.lecture_id + '-' + datas.data.user_id + ')">\
                                        <div class="view overlay">\
                                            <a href="#"><img src="' + datas.data.data_image + '" hash="" alt="' + datas.data.username + '" class="card-img-top  student_whiteboard sd-' + datas.data.lecture_id + '-' + datas.data.user_id + ' main_whiteboard">\
                                                <div class="mask rgba-white-slight"></div>\
                                            </a>\
                                        </div>\
                                        <div class="card-body p-0 name_display">\
                                            <p class="card-text text-center">\
                                                <i class="fas fa-user"></i>\
                                                <span>' + datas.data.username + '</span> \
                                            </p>\
                                        </div>\
                                    </div>\
                                </div>');
                            } else {
                                $(".sd-" + datas.data.lecture_id + '-' + datas.data.user_id).attr('src', datas.data.data_image);
                            }
                        }
                    }
                }
            });
        }

    }

    function openStudentModal(name, image, modalclass) {
        $("#updatemodal").html('');
        $("#updatemodal").append('<div class="modal-content">\
            <div class="modal-header bg-primary">\
                <p class="heading lead name_display"><span class="text-white">' + name + '</span></p> <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true" class="text-white">×</span></button>\
            </div>\
            <div class="modal-body text-center"><img  src="' + image + '" id="modal_image" style="height: 560px;" class="img-fluid ' + modalclass + ' student_whiteboard">\
                <hr>\
            </div>\
            <div class="modal-footer">\
                <a type="button" data-dismiss="modal" class="btn waves-effect grey-text"><i class="fas fa-times grey-text"></i> Close</a>\
            </div>\
        </div>');
        // <div class="row">\
        //             <div class="col-6 text-center m-0 p-0">\
        //                 <div class="text-muted grey-text" style="font-size: 70%;">\
        //                     FEEDBACK\
        //                 </div> <a data-placement="bottom" data-toggle="tooltip" title="" class="btn-floating material-tooltip-main mx-0 m-md-2  waves-effect waves-light" title="Write comment">\
        //                     <i class="fas fa-comment-lines text-primary"></i></a>\
        //                      <a data-placement="bottom" data-toggle="tooltip" title="" class="btn-floating material-tooltip-main mx-0 m-md-2 waves-effect waves-light" title="View feedback history"><i class="fas fa-list-alt text-primary"></i></a>\
        //                       <a data-placement="bottom" data-toggle="tooltip" title="" class="btn-floating material-tooltip-main mx-0 m-md-2 waves-effect waves-light" title="Enter student live session">\
        //                       <i class="fas fa-people-arrows text-primary"></i></a>\
        //             </div>\
        //             <div class="col-6 text-center m-0 p-0">\
        //                 <div class="text-muted grey-text" style="font-size: 70%;">\
        //                     QUICK REACTIONS\
        //                 </div> <a data-placement="bottom" data-toggle="tooltip" title="" class="btn-floating btn material-tooltip-main mx-0 m-md-2 waves-effect waves-light" title="Quick like feedback"><i class="fas fa-heart text-danger"></i></a> \
        //                 <a data-placement="bottom" data-toggle="tooltip" title="" class="btn-floating material-tooltip-main mx-0 m-md-2 waves-effect waves-light" title="Quick thumbs up feedback"><i class="fas fa-thumbs-up text-default"></i></a>\
        //                  <a data-placement="bottom" data-toggle="tooltip" title="" class="btn-floating material-tooltip-main mx-0 m-md-2 waves-effect waves-light" title="Quick thumbs down feedback"><i class="fas fa-thumbs-down text-danger"></i></a>\
        //             </div>\
        //         </div>\
        $("#exampleModalCenter").modal({
            backdrop: 'static',
            keyboard: false
        }, "show");
    }
 
    i = 1;
 
    Zwibbler.directive("custom-tool", (function(e) {
        e.listen("click", (function(t) {
            if ("clearCanvas" == e.value) clearwhiteboard(e.scope);
            if ("math" === e.value) {
                $("#mathModal").modal("show");
            }
        }))
    }));
    $("#protractor-btn").on("click", (function() {
        var t = Zwibbler.instances[0],
            a = t.createNode("ImageNode", {
                url: "{{asset('public/whiteboard/images/protractor-triangle.png')}}",
                lockAspectRatio: !0,
                zIndex: 1
            });
        t.scaleNode(a, .3377, .3377), t.translateNode(a, 20, 20), t.usePickTool()
        $("#mathModal").modal("hide");
    }));
    $("#mathModal-save-btn").on("click", (function( ) { 
        const mf = document.querySelector('#mathlive-equation-editor');
         mfs = mf.value.replaceAll("\\placeholder{⬚}", "\\:\\:\\:").replaceAll("\\placeholder{}", "\\:\\:\\:");
        var e = Zwibbler.instances[0];  
      
        var n = e.createNode("CustomNode", {
            nodeType: "MathJaxNode",
            latex: mfs
        });
        e.setNodeTransform.apply(e, [n].concat(D(e.getNodeTransform(o)))), e.deleteNode(o), o = n, e.commit(!0), $("#equation-tool").data("node-reference", o), a("Migrated to SVG")
        $("#math-btn-group").show();
        $("#equation-tool").hide();
        $("#math-content").hide(); 
        $("#mathModal-save-btn").hide();
        $("#mathModal").modal("hide");
    }));
    $("#ruler-btn").on("click", (function() {
        var t = Zwibbler.instances[0],
            a = t.createNode("ImageNode", {
                url: "{{asset('public/whiteboard/images/ruler.png')}}",
                lockSize: !0,
                zIndex: 1
            });
        t.scaleNode(a, .6, .6), t.usePickTool()
    }))
    
    function replaceMathTool(value){
      
        if(value == 'piechart'){
            $('#pie-chart-tool').show();
            $("#math-content").show();
            $("#math-btn-group").hide();
        }
    }
</script> 
@endsection
@extends('layouts.admin')
@section('css')
<link href="{{ asset('public/whiteboard/whiteboard.css') }}" rel="stylesheet"> 
<link href="https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro@4cac1a6/css/all.css" rel="stylesheet" type="text/css" />
<style>
    zwibbler {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        display: flex;
        flex-flow: row nowrap;
    }

    .tools {
        background: #f5f5f5;
        flex: 0 0 200px;
        display: flex;
        flex-flow: column nowrap;
        overflow-y: scroll;
        padding: 10px;
        font-family: Ubuntu;
    }

    [z-canvas] {
        flex: 1 1 auto;
    }

    .tools button {
        font-family: inherit;
        font-size: 100%;
        padding: 5px;
        display: block;
        background-color: white;
        border: none;
        border-radius: 2px;
        border-bottom: 2px solid #ddd;
        width: 100%;
    }

    .tools button[tool] {
        display: inline-block;
        width: 60px;
        height: 60px;
        font-size: 30px;
    }

    .tools button.option {
        border: 0;
        padding: 10px;
        border-radius: 3px;
        background: transparent;
        text-align: left;
    }

    .tools button.selected {
        background: #dbe6d7;
    }

    .tools button.hover {
        background: #ddd;
    }

    .tools hr {
        border: none;
        border-top: 1px solid #ccc;
    }

    .tools select {
        width: 100%;
    }

    [swatch] {
        border: 1px solid black;
        display: inline-block;
        height: 2em;
        width: 4em;
        vertical-align: middle;
        margin-right: 10px;
    }

    .colour-picker {
        padding: 10px 0;
    }

    .pages {
        flex: 0 0 100px;
        background: #ccc;
        display: flex;
        flex-flow: row nowrap;
        overflow-x: scroll;
        overflow-y: hidden;
        align-items: center;
    }

    .page {
        border: 3px solid transparent;
        margin: 5px;
        display: inline-block;
        box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.2);
    }

    .page.selected {
        border: 3px solid orange;
    }

    [z-popup] {
        background: #ccc;
        padding: 10px;
        box-shadow: 2px 2px 2px rgba(0, 0, 0.2);
    }
</style>

<!-- <script src="http://zwibbler.com/zwibbler-demo.js"></script> -->

<script type="text/javascript" src="{{asset('public/whiteboard/js/zwibbler2.js?id=119728db7e5ea158ea07')}}"></script>
@endsection
@section('start_time', $start_time)
@section('end_time', $end_time) 
@section('content')
<div class="app-content content pt-2 pb-2 p-2" data-auth-user="{{Auth::id()}}" data-auth-role="{{Auth::user()->role_id}}">
    @if($lecture->state == 1)
<button class="btn btn-primary @if($lecture->state == 1) btn-danger @endif my-2 my-sm-0 " id="start_class"
    type="button">End Class </button> 
@elseif($lecture->state == 0)
<button class="btn  @if($lecture->state == 0) btn-primary @endif my-2 my-sm-0 " id="start_class" type="button">Start
    Class </button>
@endif
<a class="btn btn-primary  my-2 my-sm-0 "  id="whiteboard" href="{{url('class/whiteboard',$lecture->id)}}" target="_blank">White Board </a> 

    <div class="card">
        <div class="card-header" style="background-image:linear-gradient(to right, #9f78ff, #32cafe);color:white;">
            <h4><i class="fas fa-chalkboard-teacher fa-fw"></i> {{$lecture->title}} Whiteboard</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12" style="overflow-y: scroll; height: 1000px;">
                    <zwibbler showToolbar="false" pageView="true" defaultPaperSize="letter landscape" style="height: 1000px;">
                        <div class="tools col-12 card mx-0 px-0" z-init="library=0">
                            <div z-init="hasFeedback=0">
                                <div z-init="smoothRefresh=0"></div>
                                <!-- wss://eu-collab-01.whiteboard.fi/socket -->
                                <div z-init="collabUrl=''"></div>
                                <div z-init="hasAssignments='0'"></div>
                                
                                <button tool class="btn" z-on:click="usePickTool()" title="Select" z-class="{selected:getCurrentTool()=='pick'}" data-sentry-click="Select Tool">
                                    <i class="fas fa-mouse-pointer"></i>
                                </button>
                                <button tool class="btn" z-on:click="useBrushTool()" title="Draw" z-class="{selected:getCurrentTool()=='brush'}" data-sentry-click="Draw Tool">
                                    <i class="fas fa-pencil-alt"></i>
                                </button><button tool class="btn" z-show-popup="toolSettingsPopup" data-sentry-click="Tool Settings Modal Button"><i class="fas fa-pencil-paintbrush"></i></button>
                               
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
                                <button tool class="btn" onclick="$('#modal-license').modal('show')" title="Insert PDF" data-sentry-click="Insert PDF Button, license modal">
                                    <i class="fas fa-file-pdf"></i>
                                </button>
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
                                <button tool class="btn" z-show-popup="menu-flatten"><i class="fas fa-layer-minus" data-sentry-click="Flatten Modal Button"></i></button>
                                <div z-popup="menu-flatten" z-show-position="bl tl" z-click-dismiss>
                                    <small>Flattening the image will take everything and move it to the background.</small><br>
                                    <button class="btn" z-show-popup="menu-flatten" z-custom-tool="flattenImage" data-sentry-click="Flatten Modal Button, Confirm"><i class="fas fa-layer-minus"></i> Flatten image</button>
                                </div>
                                <button tool class="btn" title="Insert Small Grid" data-sentry-click="Insert Small Grid Button" z-click="setConfig('backgroundImage','{{asset('public/whiteboard/images/grid_1200x800.png')}}')"><i class="fal fa-th"></i></button>
                                <button tool class="btn" title="Insert Large Grid" data-sentry-click="Insert Large Grid Button" z-click="setConfig('backgroundImage','{{asset('public/whiteboard/images/grid_1200x800_large.png')}}')"><i class="fal fa-th-large"></i></button>
                                <button tool class="btn" title="Insert Music Sheet" data-sentry-click="Insert Music Sheet Button" z-click="setConfig('backgroundImage','{{asset('public/whiteboard/images/music_new_1200x800.png')}}')"><i class="fas fa-music"></i></button>
                                <button tool class="btn" title="Insert Emoji" data-sentry-click="Insert Emoji Button" z-custom-tool="emojiButton"><i class="fal fa-smile"></i></button>
                                <button tool class="btn" title="Insert Math" data-sentry-click="Insert Math Button" z-custom-tool="math"><i class="fas fa-square-root-alt"></i></button>
                                <button tool class="btn" z-show-popup="menu-clear-foreground" data-sentry-click="Clear Modal Button"><i class="fas fa-eraser"></i></button>
                                <div z-popup="menu-clear-foreground" z-show-position="bl tl" z-click-dismiss>
                                    <button class="btn btn-block" z-custom-tool="eraserToolButton" data-sentry-click="Clear Modal, Eraser"><i class="fas fa-eraser"></i> Use the eraser tool</button>
                                    <button class="btn btn-block red-text" z-custom-tool="clearForeground" data-sentry-click="Clear Modal, Clear FG"><i class="fas fa-eraser"></i> Clear foreground but keep background</button>
                                    <button class="btn btn-block red-text" z-custom-tool="clearBackground" data-sentry-click="Clear Modal, Clear BG"><i class="fas fa-image-polaroid"></i> Clear background but keep foreground</button>
                                    <button class="btn btn-block red-text" z-custom-tool="clearCanvas" data-sentry-click="Clear Modal, Clear Both"><i class="fas fa-trash"></i> Clear both foreground and background</button><br>
                                    <small>The whiteboard is a vector image, which means you can use the Select tool to select objects and delete them separately. <br>The eraser tool paints with the background colour in order to simulate a normal eraser.<br>Note that the background cannot be erased using the eraser tool.</small>
                                </div>
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
                        <div class="col-12">
                        <div style="display:flex;flex-flow:column;flex: 1 1 auto;min-width:0">
                            <div z-canvas></div>
                            <div class="pages">
                                <button title="Insert page" z-click="insertPage()"><i class="fas fa-plus"></i></button>
                                <button title="Delete page" z-click="deletePage()"><i class="fas fa-minus"></i></button>
                                <div z-for="mypage in getPageCount()">
                                    <div z-page="mypage" z-height="70" class="page" z-class="{selected: mypage==getCurrentPage()}" z-click="setCurrentPage(mypage)"></div>
                                </div>
                            </div>
                        </div>
                        </div>
                        
                        <div z-popup="my-menu">
                            <button z-click="download('png', 'drawing.png')">PNG</button>
                            <button z-click="download('jpg', 'drawing.jpg')">JPG</button>
                            <button z-click="download('svg', 'drawing.svg')">SVG</button>
                            <button z-click="download('pdf', 'drawing.pdf')">PDF</button>
                        </div>
                    </zwibbler>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
    Zwibbler.enableConsoleLogging();
</script>
@endsection

@extends('layouts.admin')
@section('title', $lecture->title)
@section('css')
<style>
    #whiteboard{
        margin-left: 12px;
    }
</style>
@endsection
@section('start_time', $start_time)
@section('end_time', $end_time)
@section('start_button')
@if($lecture->state == 1)
<button class="btn btn-primary @if($lecture->state == 1) btn-danger @endif my-2 my-sm-0 " id="start_class"
    type="button">End Class </button> 
@elseif($lecture->state == 0)
<button class="btn  @if($lecture->state == 0) btn-primary @endif my-2 my-sm-0 " id="start_class" type="button">Start
    Class </button>
@endif
<a class="btn btn-primary  my-2 my-sm-0 "  id="whiteboard" href="{{url('class/whiteboard',$lecture->id)}}" target="_blank">White Board </a> 

@endsection

@section('content')
<div class="app-content content page" data-auth-user="{{Auth::id()}}" data-auth-role="{{Auth::user()->role_id}}">
    <div class="sidebar-left sidebar-fixed">
        <div class="sidebar">
            <div class="sidebar-content card d-none d-lg-block">
                <div class="card-body chat-fixed-search">
                    <fieldset class="form-group position-relative has-icon-left m-0  w-100 display-inline">
                        <input type="text" class="form-control round" id="searchUser" placeholder="Search user">
                        <div class="form-control-position">
                            <i class="ft-search"></i>
                        </div>
                    </fieldset>
                    {{-- <span class="float-right primary font-large-1 cursor-pointer"> <i class="ft-mic"></i> </span> --}}
                </div>
                <div id="users-list" class="list-group position-relative" data-users="{{json_encode($users)}}">
                    <div class="users-list-padding media-list">
                        <a href="#" id="lecture_{{ $lecture->id }}" data-id="{{ $lecture->id }}" data-type="channel"
                            data-channel="channel_{{ $lecture->id }}"
                            data-url="{{ url('class/student/get/messages') }}/{{ $lecture->id }}"
                            class="select-user render-class media border-bottom-blue-grey border-bottom-lighten-5 class-name show-paperclip"
                            data-avatar="{{ asset('public') }}/app-assets/images/portrait/small/avatar-s-1.png"
                            data-chat-type="lecture">
                            <div class="media-left pr-1">
                                <span class="avatar avatar-md">
                                    <div class="img-box">
                                        <img class="media-object rounded-circle"
                                            src="{{ asset('public') }}/app-assets/images/icons/lecture.png"
                                            alt="Generic placeholder image" onerror="this.src='imagefound.gif';">
                                    </div>
                                </span>
                            </div>
                            <div class="media-body w-100">
                                <h6 class="list-group-item-heading font-medium-1 text-bold-700">
                                    <label>{{ $lecture->title }} ({{$lecture->section->name}})</label>
                                    &nbsp;
                                    <i class="ft-circle font-small-2 success"></i>
                                    <span class="float-right primary">
                                    </span>
                                </h6>
                            </div>
                        </a>
                        @if (Auth::user()->isInstructor() || Auth::user()->isAdmin())
                        @foreach ($users as $user)
                        <a href="#" id="user_{{ $user->id }}" data-id="{{ $user->id }}" data-type="private"
                            data-channel="{{ ($user->role_id == 1 || $user->role_id == 3)? Auth::id() : $user->id }}_instructor"

                            data-url="{{ url('class/student/get/messages') }}/{{ $user->id }}"
                            class="select-user media border-bottom-blue-grey border-bottom-lighten-5 hide-paperclip"
                            data-avatar="{{ asset('public') }}/app-assets/images/portrait/small/avatar-s-1.png"
                            data-chat-type="user">
                            <div class="media-left pr-1">
                                <span class="avatar avatar-md">
                                    <div class=" img-box">
                                        <b>{{ $user->first_name[0] }}{{ $user->last_name[0] }}</b>
                                    </div>
                                    {{-- <img class="media-object rounded-circle" src="{{ asset('public') }}/app-assets/images/portrait/small/avatar-s-3.png"
                                    alt="Generic placeholder image"> --}}
                                </span>
                            </div>
                            <div class="media-body w-100">
                                <h6 class="list-group-item-heading font-medium-1 text-bold-700">
                                    <label>{{ $user->first_name }}</label>
                                    &nbsp;
                                    <i class="ft-circle font-small-2 success"></i>
                                    <span class="float-right primary"></span>
                                </h6>
                            </div>
                        </a>
                        @endforeach
                        @endif

                        @php
                        $user = $lecture->user;
                        @endphp
                        @if (Auth::user()->roles->contains(App\User::ROLE_STUDENT))
                        @foreach ($users as $user)
                        @if($user->isInstructor())
                        <a href="#" id="user_{{ $user->id }}" data-id="{{ $user->id }}" data-type="private"
                            data-channel="{{ ($user->role_id == 3 || $user->role_id == 1)? Auth::id() : $user->id }}_instructor"
                            data-url="{{ url('class/student/get/messages') }}/{{ $user->id }}"
                            class="select-user media border-bottom-blue-grey border-bottom-lighten-5 "
                            data-avatar="{{ asset('public') }}/app-assets/images/portrait/small/avatar-s-1.png"
                            data-chat-type="user">

                            <div class="media-left pr-1">
                                <span class="avatar avatar-md">
                                    <div class=" img-box">
                                        <b>{{ $user->first_name[0] }}{{ $user->last_name[0] }}</b>
                                    </div>
                                    {{-- <img class="media-object rounded-circle" src="{{ asset('public') }}/app-assets/images/portrait/small/avatar-s-3.png"
                                    alt="Generic placeholder image"> --}}
                                </span>
                            </div>
                            <div class="media-body w-100">
                                <h6 class="list-group-item-heading font-medium-1 text-bold-700">
                                    <label>{{ $user->first_name }}</label>
                                    &nbsp;
                                    <i class="ft-circle font-small-2 success"></i>
                                    <span class="float-right primary">
                                        @if($user->unread)
                                        <span class="pending">
                                            {{ $user->unread }}
                                        </span>
                                        @endif
                                    </span>
                                </h6>
                                {{-- <p class="font-small-3 text-muted text-bold-500">3:55 PM</p> --}}
                            </div>
                        </a>
                        @endif
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-right" id="messages">
    </div>

    <div class="modal fade text-left" id="fileUpload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h5 class="modal-title" id="exampleModalLabel">Upload File</h5> --}}
                    <button type="button" class="close clear-dropzone" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="id_dropzone" class="dropzone" action="{{ url('file/upload') }}"
                        enctype="multipart/form-data" method="post">
                        <input type="hidden" id="lecture_id" name="lecture_id" value="{{ $lecture->id }}">
                        <input type="hidden" name="channel" id="channel" value="channel_{{ $lecture->id }}">
                    </form>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                    <button type="button" class="btn btn-primary sendFiles" style="z-index: 1000000">Send</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal light-modal fade" id="image-preview" tabindex="-1" style="z-index: 100001; padding-left:0px"
        role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="width: 100%">
        <div class="modal-dialog" style="" role="document">
            <div class="modal-content light-modal-content">
                <img src="" alt="" class="lightbox">
                <button class="popup-close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="share-message" tabindex="-1" role="dialog" aria-labelledby="share-message"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Share Message</h5>
                    <button type="button" class="close clear-dropzone" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="share">
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                    <button type="button" class="btn btn-primary send-to-class" style="z-index: 1000000">Send</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function disableBack() {
        window.onbeforeunload = function () {
            return "Are you sure you want to leave?";
        }
    }
    disableBack();

</script>

<script>
    $(document).ready(function () {
        $('.class-name').trigger('click');
    });
    $('#searchUser').on('keyup', function (e) {
        filter($(this));
    });



    function filter(element) {
        var value = $(element).val().toLowerCase();

        $("#users-list a h6 label").each(function () {
            if ($(this).text().toLowerCase().search(value) > -1) {
                $(this).parent().parent().parent().show();
            } else {
                $(this).parent().parent().parent().hide();
            }
        });
    }

    function bindImageClickEvent() {
        $('.thumbnail').on('click', function () {
            var loc = $(this).data('original');
            $('.lightbox').attr('src', loc);
        });
    }

    function praise() {
        $('.praise').on('click', function () {
            var msg = $(this).text();
            $('#input-message').val(msg);
        });
    }

    function shareMessage() {
        $('.share-message').on('click', function () {
            var msg = $(this).parent().find('p.chat-msg').text();
            $('#share').val(msg);
        });
    }

    var auth_id = $('.page').data('auth-user');
    var receiver_id = '';
    var chat_type = '';
    var auth_role = $('.page').data('auth-role');
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = false;
    var pusher = new Pusher("{{env('PUSHER_APP_KEY')}}", {
        cluster: 'ap2'
    });

    classID = $('.class-name').data('channel');
    subscribe(classID, 'my_event'); // subscription with class
    var channelState = pusher.subscribe('lecture_state_{{ $lecture->id }}');

    channelState.bind('my-event', function (data) {
        if (data.lectureState) {
            $(document).find('#input-message').removeAttr('disabled');
        } else {
            $(document).find('#input-message').attr('disabled', true);
        }
    });

    if (auth_role == '1' || auth_role == '3') {
        //if instructor
        var students = $('#users-list').data('users');
        var students = $.map( students, function( obj, i ) { return obj; } );
        for (var i = 0; i < students.length; i++) {
            subscriptionID = students[i].id + '_instructor';
            subscribe(subscriptionID, 'my_event');
        }
    } else {
        //if student
        subscriptionID = auth_id + '_instructor';
        subscribe(subscriptionID, 'my_event');
    }

    function appendMsg(data, sender) {
        var msg = renderMsg(data.msg, data.date, sender, data.from_name, data.type, data.avatar, data.isInstructor);
        $('#' + data.channel + '.chats').append(msg);
        scrollToBottom();
        bindImageClickEvent();
        shareMessage();
    }

    function subscribe(id, event) {
        var channel = pusher.subscribe(id);
        channel.bind(id, function (data) {
            if (data.type == "channel") {
                if (auth_id == data.from)
                    appendMsg(data, false);
                else
                    appendMsg(data, true);
            } else {
                if (receiver_id == data.from) {
                    //if receiver is selected reload the selected user
                    appendMsg(data, true);
                } else {
                    // if receiver is not selected add notification for that user
                    var pending = parseInt($('#user_' + data.from).find('.pending').html());
                    if (pending) {
                        $('#user_' + data.from).find('.pending').html(pending + 1);
                    } else {
                        $('#user_' + data.from).append('<span class="pending">1</span>');
                    }
                }
            }
        });
    }

    $('.select-user').click(function () {
        $('.select-user').removeClass('active-tab');
        $(this).addClass('active-tab');
        receiver_id = $(this).data('id');
        chat_type = $(this).data('chat-type')
        var channel = $(this).data('channel');
        var lecture = $('#lecture_id').val();
        var url = $(this).data('url');
        $(this).find('.pending').remove();
        var _this = $(this);
        $.ajax({
            type: 'get'
            , url: url
            , data: {
                channel: channel
                , lecture: lecture
            }
            , cache: false
            , success: function (data) {
                $('#messages').html(data);
                if (_this.hasClass('class-name')) {
                    $('#messages .file-sharing-btn').show();
                }
                bindImageClickEvent();
                praise();
                shareMessage();
                scrollToBottom();
            }
        });
    });

    $(document).on('keypress', '#input-message', function (e) {
        var key = e.which;
        if (key == 13) {
            sendMessage();
        }
    });

    $(document).on('click', '#send-message', function (e) {
        sendMessage();
    });

    function scrollToBottom() {
        $('.chat-app-window').animate({
            scrollTop: $('.chat-app-window').get(0).scrollHeight
        }, 0);
    }

    function renderMsg(msg, date, to, fromName, type = '', avatar = '', isInstructor = false) {
        var zone = '{{ Auth::user()->timezone }}';
        convertedDate = moment.utc(date).tz(zone).format("hh:mma");

        var leftClass = to ? 'chat-left' : '';
        var textColor = to ? '#777' : '#fff';
        var shareBtn = to ? 'share-right' : 'share-left';
        var share_ft = (type == "private") ? 'ft-share' : '';

        if(isInstructor == 'instructor' || isInstructor == 'admin'){
            fromNameClass = 'class="text-danger"';
        } else {
            fromNameClass = '';
        }

        var fromNameClass = isInstructor == 'instructor' ? 'class="text-danger"' : '';
        var role_label = '';

        if(isInstructor == 'admin'){
            role_label = ' (Admin)';
        } else if(isInstructor == 'instructor'){
            role_label = ' (Instructor)';
        } else {
            role_label = '';
        }


        var msg = '<div class="chat ' + leftClass + '">' +
            '<div class="chat-avatar">' +
            '<a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">' +
            avatar +
            '</a>' +
            '</div>' +
            '<div class="chat-body">' +
            '<div class="chat-content">' +
            '<p ' + fromNameClass + '><strong>' + fromName + '<small>'+role_label+'</small></strong></p>' +
            '<a href="#" class="share-message" data-toggle="modal" data-target="#share-message">' +
            '<li class="' + share_ft + ' ' + shareBtn + '" title="Share in class"></li>' +
            '</a>' +
            '<p class="chat-msg">' + msg + '</p>' +
            '<small style=color:' + textColor + '>' + convertedDate + '</small>' +
            '</div>' +
            '</div>' +
            '</div>';
        return msg;
    }

    function sendMessage() {
        var message = $("#input-message").val();
        if (message != "" && receiver_id != "") {
            if (chat_type == 'lecture') {
                var type = $('#lecture_' + receiver_id).data('type');
                var channel = $('#lecture_' + receiver_id).data('channel');
            } else {
                var type = $('#user_' + receiver_id).data('type');
                var channel = $('#user_' + receiver_id).data('channel');
            }
            var text_message = true;
            $.ajax({
                type: "post"
                , url: "{{ url('class/student/send/message/') }}"
                , data: {
                    "_token": '{{ csrf_token() }}'
                    , receiver_id: receiver_id
                    , message: message
                    , type: type
                    , channel: channel
                    , lecture_id: "{{ $lecture->id }}"
                    , message_type: text_message
                }
                , cache: false
                , success: function (data) {
                    $('#share').val(message);
                    $("#input-message").val('');
                    var msg = renderMsg(message, data.date, false, data.from_name, data.type, data.avatar, data.isInstructor);
                    if (type != "channel"){
                        $('.chats').append(msg);
                    }
                }
                , error: function (jqXHR, status, err) {}
                , complete: function () {
                    scrollToBottom();
                }
            });
        }
    }

    $('.send-to-class').on('click', function () {
        var message = $('#share').val();
        if (message != "") {
            var type = $('.class-name').data('type');
            var channel = $('.class-name').data('channel');
            var text_message = true;
            $.ajax({
                type: "post"
                , url: "{{ url('class/student/send/message/') }}"
                , data: {
                    "_token": '{{ csrf_token() }}'
                    , receiver_id: receiver_id
                    , message: message
                    , type: type
                    , channel: channel
                    , lecture_id: "{{ $lecture->id }}"
                    , message_type: text_message
                    ,
                }
                , cache: false
                , success: function (data) {
                    $('#share').val('');
                    $('#share-message').modal('hide');
                    $('.class-name').trigger('click');
                },

                error: function (jqXHR, status, err) {}
                , complete: function () {
                    scrollToBottom();
                }
            });
        }
    });

    $('.sendFiles').click(function () {
        myDropzone.processQueue();
        myDropzone.on("complete", function (file) {
            myDropzone.removeFile(file);
            $('#fileUpload').modal('hide');
        });
    });

</script>

<script>
    $('#start_class').click(function () {
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
            type: "get"
            , url: "{{ url('class/lecture/state/'.$lecture->id) }}"
            , data: {
                state: state
            }
            , success: function (data) {
                console.log(data);
            }
        });
    }

</script>

@endsection
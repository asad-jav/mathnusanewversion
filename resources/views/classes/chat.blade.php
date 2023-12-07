<div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
    </div>
    <div class="content-body">
        {{-- <div class="alert alert-primary">hello</div> --}}
        <section class="chat-app-window" style="background-image: url('/public/app-assets/images/logo/math-logo.jpeg')">
            <div class="mb-1 secondary text-bold-700">Chat History</div>  
            <div class="chats" id="{{ $channel }}">
                @foreach ($messages as $msg)
                    <div class="chat 
                        @if($msg->from != Auth::id()) chat-left @endif
                        ">
                        <div class="chat-avatar">
                            <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                @php
                                    $firstname = $msg->fromUser->first_name;
                                    $lastname = $msg->fromUser->last_name;
                                @endphp
                                @if ($msg->fromUser->avatar != '')
                                    <img src="{{ asset('public/profile_images/'.$msg->fromUser->avatar) }}"  onerror="this.src='{{asset('public/dummy-img.png')}}'" class="box-shadow-4" alt="avatar" />
                                @else
                                    <div class="img-box box-shadow-4">
                                        <b>{{ $firstname[0] }}{{ $lastname[0] }}</b>
                                    </div>
                                @endif
                            </a>
                        </div>
                        <div class="chat-body">
                            <div class="chat-content ">
                                <p class="{{ ($msg->fromUser->isAdmin() || $msg->fromUser->isInstructor()) ? 'text-danger' : '' }}"><strong>{{ $msg->fromUser->first_name.' '.$msg->fromUser->last_name }}<small>@if($msg->fromUser->isAdmin()) (Admin) @endif @if($msg->fromUser->isInstructor()) (Instructor) @endif</small></strong></p>




                                @if($msg->type == 1)
                                    <a href="#" class="share-message" data-toggle="modal" data-target="#share-message">
                                        <li class="ft-share @if($msg->from != Auth::id()) share-right @else share-left @endif" title="Share in class"></li>
                                    </a>
                                @endif
                                @if($msg->message_type == 1)
                                    <p class="chat-msg">{{ $msg->message }}</p>
                                @else
                                    <img src="{{ asset('public').'/'.$msg->thumbnail }}" data-original = "{{ asset('public').'/'.$msg->file }}" alt="" class="thumbnail img-rounded" data-toggle="modal" data-target="#image-preview">
                                    <br>
                                @endif
                                @php
                                    $msgTime = Carbon\Carbon::parse($msg->created_at)->setTimezone(Auth::user()->timezone)->format("h:ia");
                                @endphp
                                <small style="color:{{ ($msg->from == Auth::id())? '#fff': '#777' }}">{{ $msgTime }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <section class="chat-app-form overflow-visible">
            @php 
                $lectureTime = Carbon\Carbon::parse($lecture->datetime.' '.$lecture->start_time)->setTimezone(Auth::user()->timezone);
            @endphp
            @if($lectureTime->addMinutes($lecture->duration*60)->isPast() && $lecture->state == App\Lecture::ENDED)
                <h3 class="text-danger text-center" style="padding: 30px 10px;"> Opps...! The class has been Ended. </h3>
            @else
            <form class="chat-app-input d-flex mb-5" autocomplete="off">
                <fieldset class="col-10 m-0">
                    <div class="input-group">
                        <div class="input-group position-relative has-icon-left">
                            <div class="form-control-position file-sharing-btn" data-toggle="modal" data-target="#fileUpload" style="display:none">
                                <span id="basic-addon3"><i class="ft-paperclip"></i></span>
                            </div>
                            <input type="text" class="form-control form-control-sm" id="input-message" placeholder="Send message" aria-describedby="button-addon2" value="">
                            
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Praise</button>
                                <div class="dropdown-menu">
                                    @foreach($praises as $praise)
                                        <a class="dropdown-item praise">{{ $praise->msg }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                      </div>
                </fieldset>
                <fieldset class="form-group position-relative has-icon-left col-2 m-0">
                    <button type="button" class="btn btn-danger btn-sm" id="send-message">
                        <i class="la la-paper-plane-o"></i>
                    </button>
                </fieldset>
            </form>
            @endif
        </section>
    </div>
</div>

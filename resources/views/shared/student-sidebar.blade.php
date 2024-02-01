
<!-- BEGIN: Main Menu-->

<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" style="z-index: 10000" data-scroll-to-active="true" data-img="{{ asset('backend/app-assets/images/backgrounds/02.jpg')}}">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{ url('student/dashboard') }}"><img class="brand-logo" alt="Chameleon admin logo" src="{{ asset('backend/app-assets/images/logo/t-logo.png')}}" style="width: 70px;"/>
                    <h3 class="brand-text">
                        MATHNUSA
                    </h3>
                </a>
            </li>
            <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
        </ul>
    </div>
    <div class="navigation-background"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item {{Request::is('student/dashboard') ? 'active' : ''}}">
                    <a href="{{ url('student/dashboard') }}" class="{{Request::is('student/dashboard') ? 'active' : ''}}">
                        <i class="ft-home"></i>
                        <span class="menu-title" data-i18n="">Dashboard </span>
                    </a>
                </li>
                <li class=" nav-item">
                    <a href="#">
                        <i class="ft-file"></i>
                        <span class="menu-title" data-i18n="">Courses</span>
                    </a>
                    <ul class="menu-content">
                        {{-- <li class="@if(Request::is('student/course/list')) active @endif">
                            <a class="menu-item" href="{{ url('student/course/list') }}">Available Courses</a>
                        </li> --}}
                        <li class="@if(Request::is('student/course/enrolled')) active @endif">
                            <a class="menu-item" href="{{ url('student/course/enrolled') }}">Enrolled Courses</a>
                        </li>
                    </ul>
                </li>  
                <li class="nav-item {{ Request::is('student/quizizz') || Request::is('student/quiz/live-quizz') || Request::is('student/quiz/complete-quizz') ? 'active' : ''}}">
                    <a href="#">
                        <i class="ft-book"></i>
                        <span class="menu-title" data-i18n="">CFU</span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{ Request::is('student/quiz/live-quizz') ? 'active' : ''}}">
                            <a class="menu-item" href="{{ url('student/quiz/live-quizz') }}">Live CFU</a>
                        </li> 
                        <li class="{{ Request::is('student/quiz/complete-quizz') ? 'active' : ''}}">
                            <a class="menu-item" href="{{ url('student/quiz/complete-quizz') }}">Complete CFU</a>
                        </li>  
                    </ul>
                </li>
                <li class=" nav-item {{ Request::is('video') ? 'active' : ''}}">
                    <a class="menu-item" href="{{ url('video') }}">
                        <i class="ft-video"></i>
                        <span class="menu-title" data-i18n="">Videos</span>
                    </a>
                </li>
                <li class=" nav-item">
                    <a href="#">
                        <i class="ft-layers"></i>
                        <span class="menu-title" data-i18n="">Paises</span>
                    </a>
                    <ul class="menu-content">
                        <li class="@if(Request::is('praise')) active @endif">
                            <a class="menu-item" href="{{ url('praise') }}">All Praises</a>
                        </li>
                        <li class="@if(Request::is('praise/create')) active @endif">
                            <a class="menu-item" href="{{ url('praise/create') }}">Create Praise</a>
                        </li>
                    </ul>
                </li>

        </ul>
    </div>
</div>

<!-- END: Main Menu-->

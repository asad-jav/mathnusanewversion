
<!-- BEGIN: Main Menu-->

<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" style="z-index: 10000" data-scroll-to-active="true" data-img="{{ asset('backend/app-assets/images/backgrounds/02.jpg')}}">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{ url('instructor/dashboard') }}"><img class="brand-logo" alt="Chameleon admin logo" src="{{ asset('backend/app-assets/images/logo/t-logo.png')}}" style="width: 70px;"/>
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
                <li class="nav-item">
                    <a href="{{ route('instructor.dashboard') }}">
                        <i class="ft-home"></i>
                        <span class="menu-title" data-i18n="">Dashboard </span>
                    </a>
                </li>
                <li class=" nav-item">
                    <a href="#">
                        <i class="ft-book"></i>
                        <span class="menu-title" data-i18n="">Courses</span>
                    </a>
                    <ul class="menu-content">
                        <li class="@if(Request::is('course/index') || Request::is('course/lectures/*')) active @endif">
                            <a class="menu-item" href="{{ url('course/index') }}">All Courses</a>
                        </li>
                        <li class="@if(Request::is('course/create') || Request::is('course/edit/*')) active @endif">
                            <a class="menu-item" href="{{ url('course/create') }}">Create Course</a>
                        </li>
                        <li class="@if(Request::is('lecture/index')) active @endif">
                            <a class="menu-item" href="{{ url('lecture/index') }}">All Lectures</a>
                        </li>
                        <li class="@if(Request::is('lecture/create')) active @endif">
                            <a class="menu-item" href="{{ url('lecture/create') }}">Create Lecture</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  {{ Request::is('quizizz') || Request::is('quizizz/create') || Request::is('quizz-question/create/*') || Request('quizizz/*') || Request::is('quizizz/*/edit')  ? 'active' : ''}}">
                    <a href="{{ url('quizizz') }}">
                        <i class="ft-book"></i>
                        <span class="menu-title" data-i18n="">Quizziz </span>
                    </a>
                </li> 
                <li class=" nav-item">
                    <a href="#">
                        <i class="ft-users"></i>
                        <span class="menu-title" data-i18n="">Sections</span>
                    </a>
                    <ul class="menu-content">
                        <li class="@if(Request::is('sections') || Request::is('sections/edit/*') || Request::is('sections/lectures/*')) active @endif">
                            <a class="menu-item" href="{{ route('sections') }}">All Sections</a>
                        </li>
                        <li class="@if(Request::is('sections/create')) active @endif">
                            <a class="menu-item" href="{{ route('sections.create') }}">Create</a>
                        </li>
                    </ul>
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

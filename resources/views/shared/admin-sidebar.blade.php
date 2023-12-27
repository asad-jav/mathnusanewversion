<!-- BEGIN: Main Menu-->

<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" style="z-index: 10000" data-scroll-to-active="true" data-img="{{ asset('backend/app-assets/images/backgrounds/02.jpg')}}">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{ url('admin/dashboard') }}"><img class="brand-logo" alt="Chameleon admin logo" src="{{ asset('backend/app-assets/images/logo/t-logo.png')}}" style="width: 70px;"/>
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
                    <a href="{{ url('admin/dashboard') }}">
                        <i class="ft-home"></i>
                        <span class="menu-title" data-i18n="">Dashboard </span>
                    </a>
                </li>
                <li class="nav-item {{Request::is('admin/grades') ? 'open active' : ''}}">
                    <a href="{{ url('admin/grades') }}" class=" {{Request::is('admin/grades') ? 'open active' : ''}}">
                        <i class="ft-star"></i>
                        <span class="menu-title" data-i18n="">Grades </span>
                    </a>
                </li>
                <li class="nav-item {{Request::is('admin/standards') || Request::is('admin/standards/create')  ? 'open active' : ''}}">
                    <a href="{{ url('admin/standards') }}" class=" {{Request::is('admin/standards') ? 'open active' : ''}}">
                        <i class="ft-star"></i>
                        <span class="menu-title" data-i18n="Standards">Standards </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="ft-grid"></i>
                        <span class="menu-title" data-i18n="">Categories </span>
                    </a>
                    <ul class="menu-content">
                        <li class="@if(Request::is('category')) active @endif">
                            <a class="menu-item" href="{{ url('category') }}">All Categories</a>
                        </li>
                        <li class="@if(Request::is('category/create')) active @endif">
                            <a class="menu-item" href="{{ url('category/create') }}">Create Category</a>
                        </li>
                    </ul>
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
                <li class="nav-item  {{ Request::is('quizizz')  || Request::is('student/quizizz/answers/*/*')  || Request::is('student/quizizz/view/*')  || Request::is('quizizz/create') || Request::is('quizz-question/create/*') || Request('quizizz/*') || Request::is('quizizz/*/edit')  ? 'active' : ''}}">
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
                        <i class="ft-users"></i>
                        <span class="menu-title" data-i18n="">Users</span>
                    </a>
                    <ul class="menu-content">
                        <li class="@if(Request::is('student/index')) active @endif">
                            <a class="menu-item" href="{{ url('student/index') }}">Students</a>
                        </li>
                        <li class="@if(Request::is('admin/instructors')) active @endif">
                            <a class="menu-item" href="{{ route('admin.instructors') }}">Instructors</a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item">
                    <a href="#">
                        <i class="ft-video"></i>
                        <span class="menu-title" data-i18n="">Videos</span>
                    </a>
                    <ul class="menu-content">
                        <li class="@if(Request::is('video')) active @endif">
                            <a class="menu-item" href="{{ url('video') }}">All Videos</a>
                        </li>
                        <li class="@if(Request::is('video/create')) active @endif">
                            <a class="menu-item" href="{{ url('video/create') }}">Add Video</a>
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

            @if (Auth::user()->roles->contains(App\Models\User::ROLE_STUDENT))
                <li class="nav-item">
                    <a href="{{ url('student/dashboard') }}">
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

                <li class=" nav-item">
                    <a class="menu-item" href="{{ url('video') }}">
                        <i class="ft-video"></i>
                        <span class="menu-title" data-i18n="">Videos</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('packages') }}">
                        <i class="ft-package"></i>
                        <span class="menu-title" data-i18n="">Assignments </span>
                    </a>
                </li> --}}
            @endif
        </ul>
    </div>
</div>

<!-- END: Main Menu-->

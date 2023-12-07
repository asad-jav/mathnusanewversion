<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Chameleon Admin is a modern Bootstrap 4 webapp &amp; admin dashboard html template with a large number of components, elegant design, clean and organized code.">
    <meta name="keywords" content="admin template, Chameleon admin template, dashboard template, gradient admin template, responsive admin template, webapp, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>@yield('title')</title>
    
    @include('shared.css')
    <style>
        .btn-file{
            height: 40px;
            border:2px dashed #ccc; 
            line-height:15px;
            cursor:pointer;
        }
    </style>
    @yield('css')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu 2-columns @if(Request::is('class/lecture/*')) chat-application @endif email-application content-left-sidebar fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="content-left-sidebar">
    
    @include('shared.header')
     
    @if(auth()->user()->isStudent())
        @include('shared.student-sidebar')
    @elseif(auth()->user()->isAdmin())
        @include('shared.admin-sidebar')
    @elseif(auth()->user()->isInstructor())
        @include('shared.instructor-sidebar')
    @endif
    
    @yield('content')
    {{-- @include('shared.footer') --}}
    @include('shared.js')
    @yield('script')
    
</body>
<!-- END: Body-->

</html>
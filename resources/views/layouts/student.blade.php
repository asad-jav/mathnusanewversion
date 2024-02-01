<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Chameleon Admin is a modern Bootstrap 4 webapp &amp; admin dashboard html template with a large number of components, elegant design, clean and organized code.">
    <meta name="keywords" content="admin template, Chameleon admin template, dashboard template, gradient admin template, responsive admin template, webapp, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>@yield('title')</title>

    @include('shared.css')
    @yield('css')
    
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu 2-columns  fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="2-columns">
    
    @include('shared.header')
    @if(Auth::user()->role_id == 1)
        @include('shared.admin-sidebar')
    @endif
    @if(Auth::user()->role_id == 2)
        @include('shared.student-sidebar')
    @endif
    @if(Auth::user()->role_id == 3)
        @include('shared.instructor-sidebar')
    @endif
   
    @yield('content')
    {{-- @include('shared.footer') --}}
    @include('shared.js')
    @yield('script')
    
</body>
<!-- END: Body-->

</html>
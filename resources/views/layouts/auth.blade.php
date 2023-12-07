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
    <style>
        .btn-danger {
            background-color: #e41645;
        }

        .home-button {
            color:#fff;
        }

        .home-button:hover {
            color:#e41645;
            transition: ease-in-out;
        }
        .blank-page .content-wrapper .flexbox-container {
            height: auto!important;
        }
        
        .overflow {
            overflow:hidden;
            padding-top:15px;
            padding-bottom: 15px;
        }
        .form-link p{
            margin: 5px auto;
        }
        @media only screen and (max-width: 1200px) {
        .form-link p{
            text-align: center !important;
            }
        }
    </style>
    @yield('css')

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu 1-column  bg-full-screen-image blank-page" data-open="click" data-menu="vertical-menu" data-color="" data-col="1-column" style="background:#333">
    <!-- BEGIN: Content-->
    {{-- <div class="text-center mb-1">
        <img src="{{ asset('public') }}/app-assets/images/logo/t-logo.png" class="img-auto-adjust" alt="branding logo">
    </div> --}}
    {{-- <nav class="navbar navbar-expand-lg">
        <ul class="navbar-nav ml-auto ">
            <li class="nav-item active">
                <a class="nav-link navbar-brand home-button" href="{{ url('/') }}"><strong>HOME</strong> </a>
            </li>
        </ul>
    </nav> --}}
    @yield('content')
    <!-- END: Content-->
    @include('shared.js')
    @yield('script')
</body>
<!-- END: Body-->

</html>
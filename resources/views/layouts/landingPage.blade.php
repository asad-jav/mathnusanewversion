<!DOCTYPE html>
<html class="light">
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	

		<title>Online Math Tutoring | MATHNUSA</title>	

		<meta name="keywords" content="MATHNUSA" />
		<meta name="description" content="Give your kids the gift of online math tutoring from the platform designed to enhance math learning and yield real-world results and improvements.">
		<meta name="author" content="okler.net">

		<!-- Favicon -->
		<link rel="shortcut icon" href="{{ asset('public') }}/app-assets/images/logo/t-logo.png" type="image/x-icon" />
		<link rel="apple-touch-icon" href="{{ asset('public/landing-page') }}/img/apple-touch-icon.png">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=family=Lora:400,400i,700,700i|Poppins:300,400,500,600,700,800,900&display=swap" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{ asset('public/landing-page') }}/vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="{{ asset('public/landing-page') }}/vendor/fontawesome-free/css/all.min.css">
		<link rel="stylesheet" href="{{ asset('public/landing-page') }}/vendor/animate/animate.min.css">
		<link rel="stylesheet" href="{{ asset('public/landing-page') }}/vendor/simple-line-icons/css/simple-line-icons.min.css">
		<link rel="stylesheet" href="{{ asset('public/landing-page') }}/vendor/owl.carousel/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="{{ asset('public/landing-page') }}/vendor/owl.carousel/assets/owl.theme.default.min.css">
		<link rel="stylesheet" href="{{ asset('public/landing-page') }}/vendor/magnific-popup/magnific-popup.min.css">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{ asset('public/landing-page') }}/css/theme.css">
		<link rel="stylesheet" href="{{ asset('public/landing-page') }}/css/theme-elements.css">
		<link rel="stylesheet" href="{{ asset('public/landing-page') }}/css/theme-blog.css">
		<link rel="stylesheet" href="{{ asset('public/landing-page') }}/css/theme-shop.css">

		<!-- Current Page CSS -->
		<link rel="stylesheet" href="{{ asset('public/landing-page') }}/vendor/rs-plugin/css/settings.css">
		<link rel="stylesheet" href="{{ asset('public/landing-page') }}/vendor/rs-plugin/css/layers.css">
		<link rel="stylesheet" href="{{ asset('public/landing-page') }}/vendor/rs-plugin/css/navigation.css">
		
		<!-- Demo CSS -->
		<link rel="stylesheet" href="{{ asset('public/landing-page') }}/css/demos/demo-digital-agency-2.css">

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{ asset('public/landing-page') }}/css/skins/skin-digital-agency-2.css"> 

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{ asset('public/landing-page') }}/css/custom.css">
		<!-- Demo CSS -->
		
		<style>
			html{
				scroll-behavior: smooth;
			}

			.text-black{
				color: #000;
			}

			.bg-light-silver {
				background:#f7f7f7;
			}

			.svg-icon {
				height:100px;
			}

			.font-white {
				color: #fff !important;
			}

			.input-border {
				outline: 1px solid #555
			}

			.text-ellipsis {
				display: block;
				width: 200px;
				overflow: hidden;
				white-space: nowrap;
				text-overflow: ellipsis;
			}

			.text-justify {
				font-size: 1px;
			}

			/* .btn-nav {
				background: linear-gradient(135deg, #e41645 0%, #292929 80%) !important;
			} */
			.dropdown-primary button:hover{
				/* background: linear-gradient(135deg, #292929 0%, #e41645 80%) !important; */
				background-color: #e41645 !important;
				/* color: #dc3545 !important; */
			}
			.dropdown-primary button{
				font-size:15px;
				font-weight:600;
			}
			.btn-outline-danger{
				color: #fff !important;
			}
		.slider-container:after {
			content: '';
			display: block;
			width: 101%;
			height: 100px;
			background-color: #fff;
			position: absolute;
			bottom: -48px;
			left: -1%;
			transform: rotate(2deg);
			z-index: 0 !important;
		}
		 .page-header.page-header-modern.page-header-background:after {
                content: '';
                display: block;
                width: 101%;
                height: 75px;
                left:-3px;
                bottom:-38px;
            }
		.btn-gradient:not(.btn-outline):active,
		.btn-gradient:not(.btn-outline).active {
			background-color: #e41645 !important; 
		color: #FFF !important;
		}
		.btn-gradient:not(.btn-outline) {
		background-color: #e41645 !important;
		color: #FFF;
		}
		.card-grade-us{
			position: absolute;
			padding: 8px 15px;
			color: #e41645;
			top: 56px;
			border-radius: 50px;
			left: -10px;
			font-weight: 600;
		}
		.grade .card-grade-us{
			background: #e41645;
			color: #fff;
			top:10px;
			left: -18px;
			padding: 10px 25px;
		}
		.fa-check {
    	color: #e41645;
		}
		html .btn-light:hover{
			background-color: none;
		}
		@media only screen and (max-width: 1199px) and (min-width:992px) {
			#header .header-nav.header-nav-links.header-nav-light-text nav > ul > li > a, #header .header-nav.header-nav-line.header-nav-light-text nav > ul > li > a {
				color: #FFF;
				font-size: 12px !important;
			}
			.custom-nav-us button{
				font-size:12px !important;
			}

		}
		@media only screen and (max-width: 991px) {
			#header.header-no-border-bottom .header-nav.header-nav-links nav > ul > li > a, #header.header-no-border-bottom .header-nav.header-nav-links nav > ul > li:hover > a{
				text-align: center !important;
			}
			.cus-btn-media{
				background-color: #e41645 !important;
				background:none !important;
				margin:5px !important;
			}
			.cus-btn-media button{
				background-color: #e41645 !important;
				width: 100% !important;
				border: none !important;
			}
		}
		
		/* .our-services{
			top:500px !important;
		} */
		/* ---------------- */
		

		</style>
		<!-- Head Libs -->
		<script src="{{ asset('public/landing-page') }}/vendor/modernizr/modernizr.min.js"></script>
		@yield('css')
	</head>
	<body data-spy="scroll" data-target="#mainNav" data-offset="50">
		<div class="body">
			<header id="header" class="@if(Request::is('/')) header-transparent @endif header-effect-shrink" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': false, 'stickyEnableOnMobile': false	, 'stickyChangeLogo': false, 'stickyStartAt': 1, 'stickyHeaderContainerHeight': 70}">
				<div class="header-body border-top-0 bg-color-dark text-dark box-shadow-none">
					<div class="header-container container">
						<div class="header-row">
							<div class="header-column header-column-logo">
								<div class="header-row">
									<div class="header-logo">
									  <a href="#">
											<img alt="Porto" height="59" src="{{ asset('public/app-assets/images/logo/logo-lite-version.svg') }}">
											<span class="appear-animation animated fadeInRightShorter appear-animation-visible" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="600" data-appear-animation-duration="800"><span class="d-inline-block text-primary highlighted-word-animation-1 alternative-font-3 font-weight-bold   ml-2">MATHNUSA</span></span>
										</a> 
									</div>
								</div>
							</div>
							<div class="header-column header-column-nav-menu justify-content-end w-100">
								<div class="header-row">
									<div class="header-nav header-nav-links header-nav-dropdowns-dark header-nav-light-text order-2 order-lg-1">
										<div class="header-nav-main header-nav-main-mobile-dark header-nav-main-square header-nav-main-dropdown-no-borders header-nav-main-effect-2 header-nav-main-sub-effect-1">
											<nav class="collapse custom-nav-us ">
												<ul class="nav nav-pills" id="mainNav">
                                                    {{-- @if(!Request::is('/'))
													<li class="dropdown-primary">
														<a class="nav-link text-capitalize font-weight-semibold custom-text-3 active-on-click" data-hash="" data-hash-offset="120"  onclick="goBack()" >
															HOME
														</a>
                                                    </li>
                                                    @endif --}}
                                                    {{-- @if(Request::is('/')) --}}
                                                    <li class="dropdown-primary">
														<a class="nav-link text-capitalize font-weight-semibold custom-text-3 active-on-click" data-hash="" data-hash-offset="120" href="{{ url('/#main') }}">
															HOME
														</a>
                                                    </li>
													<li class="dropdown-primary">
														<a class="nav-link text-capitalize font-weight-semibold custom-text-3 @if(Request::is('our-servicess')) active @endif active-on-click" data-hash="" data-hash-offset="120" href="{{ url('/#ourWork') }}">
															OUR SERVICES
														</a>
													</li>
													<li class="dropdown-primary">
														<a class="nav-link text-capitalize font-weight-semibold custom-text-3 active-on-click" href="{{ url('/#justAsk') }}" data-hash="" data-hash-offset="120">
															JUST ASK I.T
														</a>
													</li>
													<li class="dropdown-primary">
														<a class="nav-link text-capitalize font-weight-semibold custom-text-3 active-on-click" href="{{ url('/#wallOfFame') }}" data-hash="" data-hash-offset="120">
															WALL OF FAME
														</a>
													</li>
													<li class="dropdown-primary">
														<a class="nav-link text-capitalize font-weight-semibold custom-text-3 active-on-click" href="{{ url('/#blog') }}" data-hash="" data-hash-offset="120">
															BLOG
														</a>
													</li>
													<li class="dropdown-primary">
														<a class="nav-link text-capitalize font-weight-semibold custom-text-3 @if(Request::is('mathnopoly')) active @endif active-on-click" href="{{ url('/#mathnopoly') }}" data-hash="" data-hash-offset="120">
															MATHNOPOLY
														</a>
													</li>
													<li class="dropdown-primary">
														<a class="nav-link text-capitalize font-weight-semibold custom-text-3 @if(Request::is('about-us')) active @endif active-on-click" href="{{ url('/#aboutUs') }}" data-hash="" data-hash-offset="120">
															ABOUT US
														</a>
                                                    </li>
													
												</li>
													{{-- @endif --}}
													
													@auth
														<li class="dropdown">
															<a class="nav-link text-capitalize font-weight-semibold custom-text-3 active-on-click text-warning" href="#" onclick="
															event.preventDefault();
															document.getElementById('logout-form').submit();
															">
																LOGOUT
															</a>
															<form action="{{ route('logout') }}" id="logout-form" method="post">@csrf</form>
															<ul class="dropdown-menu">
																<li class="dropdown-primary">
																@can('admin')
																	<a class="nav-link text-capitalize font-weight-semibold custom-text-3 active-on-click text-light" href="{{ route('admin.dashboard') }}">
																		Dashboard
																	</a>
																@endcan
																@can('teacher')
																	<a class="nav-link text-capitalize font-weight-semibold custom-text-3 active-on-click text-light" href="{{ route('instructor.dashboard') }}">
																		Dashboard
																	</a>
																@endcan
																@can('student')
																	<a class="nav-link text-capitalize font-weight-semibold custom-text-3 active-on-click text-light" href="{{ route('student.dashboard') }}">
																		Dashboard
																	</a>
																@endcan
																</li>
															</ul>
														</li>
													@endauth
													
													@guest
														<li class="dropdown-primary">
															<a class="nav-link text-capitalize btn btn-gradient font-weight-semibold custom-text-3 active-on-click cus-btn-media" href="{{ url('login') }}" style=" margin:0px 5px">
																<button class="btn btn-outline-danger">LOGIN</button>
																
															</a>
														</li>
														<li class="dropdown-primary">
															<a class="nav-link text-capitalize font-weight-semibold custom-text-3 active-on-click btn btn-gradient cus-btn-media" href="{{ url('register') }}" style="margin:0px 5px">
															<button class="btn btn-outline-danger">REGISTER</button>
																 
															</a>
														</li>
														<!-- <button type="button" class="btn btn-outline-danger">Danger</button> -->
													@endguest
												</ul>
											</nav>
										</div>
										<button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav">
											<i class="fas fa-bars"></i>
										</button>
									</div>
								</div>
							</div>
							<div class="header-column justify-content-end d-none d-lg-flex">
								<div class="header-row">
									<ul class="header-social-icons social-icons social-icons-clean social-icons-icon-light social-icons-big d-lg-flex m-0 ml-lg-2">
										{{-- here will be social icons --}}
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
            </header>
            
            @yield('content')

            <footer id="footer" class="mt-0 py-5">
				<div class="container py-5">
					<div class="row justify-content-between">
						<div class="col-sm-12 col-lg-6 col-xl-6">
							<div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="100">
								<h4 class="custom-font-primary custom-newsletter-title font-weight-bold mb-4 custom-text-7">Join for Company Updates</h4>
								<div class="alert alert-success d-none" id="newsletterSuccess">
									<strong>Success!</strong> You've been added to our email list.
								</div>
								<div class="alert alert-danger d-none" id="newsletterError"></div>
								<form class="contact-form" action="" method="POST" autocomplete="off" enctype="multipart/form-data">
									<div class="contact-form-success alert alert-success d-none mt-4">
										<strong>Success!</strong> Your message has been sent to us.
									</div>
								
									<div class="contact-form-error alert alert-danger d-none mt-4">
										<strong>Error!</strong> There was an error sending your message.
										<span class="mail-error-message text-1 d-block"></span>
									</div>
									
									<div class="form-row">
										<div class="form-group col-lg-6">
											<label class="required font-weight-bold text-light text-2">Full Name</label>
											<input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control form-control-sm custom-newsletter-input rounded-0 bg-transparent pl-0 custom-text-2 text-color-light box-shadow-none input-border" name="name" required>
										</div>
										<div class="form-group col-lg-6">
											<label class="required font-weight-bold text-light text-2">Email Address</label>
											<input type="email" value="" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control form-control-sm custom-newsletter-input rounded-0 bg-transparent pl-0 custom-text-2 text-color-light box-shadow-none input-border" name="email" required>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col">
											<label class="font-weight-bold text-light text-2">Subject</label>
											<input type="text" value="" data-msg-required="Please enter the subject." maxlength="100" class="form-control form-control-sm custom-newsletter-input rounded-0 bg-transparent pl-0 custom-text-2 text-color-light box-shadow-none input-border" name="subject" required>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col">
											<label class="required font-weight-bold text-light text-2">Message</label>
											<textarea maxlength="5000" data-msg-required="Please enter your message." rows="8" class="form-control form-control-sm custom-newsletter-input rounded-0 bg-transparent pl-0 custom-text-2 text-color-light box-shadow-none input-border" name="message" required></textarea>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col">
											<input type="file" id="file" name="file" class="sr-only"/>
											<label for="file" class="btn btn-primary btn-outline btn-modern">choose a file</label>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col">
											<input type="submit" value="Join Us" class="btn btn-primary btn-modern" data-loading-text="Loading...">
										</div>
									</div>
								</form>
								
							</div>
						</div>
						<div class="col-sm-12 col-lg-6 col-xl-6 col-info-footer mt-4 mt-sm-5 mt-lg-0">
							<div class="row">
								<div class="col-md-12" style="padding-top: 66px">
									<div class="  mb-5 appear-animation animated fadeIn appear-animation-visible" data-appear-animation="fadeIn" data-appear-animation-delay="600" data-appear-animation-duration="750" style="animation-delay: 1200ms;">
										<div class="border-width-10 border-color-light clearfix border border-radius">
											<video class="float-left" width="100%" height="100%" autoplay="" muted="" loop="">
													<source src="{{ asset('public/landing-page') }}/video/Outro.mp4" type="video/mp4">
											</video>
										</div>
									</div>
								</div>
								
							</div>
						</div>
					</div>
					<div class="row justify-content-between">
						<div class="col-sm-12 col-lg-7 col-xl-6 d-none d-sm-flex">
							<div class="nav-footer w-100 pt-5 mt-0 mt-lg-4">
								<div class="row justify-content-between">
									<div class="col-auto mr-auto">
										<div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200">
											<div class="footer-nav footer-nav-links">
												<nav>
													<ul class="nav" id="footerNav">
														<li>
															<a class="text-color-hover-primary font-weight-semibold custom-text-2 text-capitalize" href="{{ url('/#ourServices') }}">Our Services</a>
														</li>
														<li>
															<a class="text-color-hover-primary font-weight-semibold custom-text-2 text-capitalize" href="{{ url('/#ourWork') }}">Our Work</a>
														</li>
														<li>
															<a class="text-color-hover-primary font-weight-semibold custom-text-2 text-capitalize" href="{{ url('/#aboutUs') }}">About Us</a>
														</li>
													</ul>
												</nav>
											</div>			
										</div>							
									</div>
									<div class="col-auto">
										<div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="100">
											<ul class="header-social-icons social-icons social-icons-clean social-icons-icon-light social-icons-big d-none d-lg-block m-0 p-relative bottom-10">
												<li class="social-icons-instagram"><a href="http://www.instagram.com/" target="_blank" class="text-4" title="Instagram"><i class="fab fa-instagram"></i></a></li>
												{{-- <li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" class="text-4" title="Twitter"><i class="fab fa-twitter"></i></a></li> --}}
												<li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" class="text-4" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-lg-5 col-xl-6">
							<div class="d-flex justify-content-end custom-footer-copywriting pt-5 mt-0 mt-lg-4">
								<p class="mb-0 text-left text-lg-right d-block w-100 appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="300">MATHNUSA TEAM. ©  2020.  All Rights Reserved</p>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>

		<!-- Vendor -->
		<script src="{{ asset('public/landing-page') }}/vendor/jquery/jquery.min.js"></script>
		<script src="{{ asset('public/landing-page') }}/vendor/jquery.appear/jquery.appear.min.js"></script>
		<script src="{{ asset('public/landing-page') }}/vendor/jquery.easing/jquery.easing.min.js"></script>
		<script src="{{ asset('public/landing-page') }}/vendor/jquery.cookie/jquery.cookie.min.js"></script>
		<script src="{{ asset('public/landing-page') }}/vendor/popper/umd/popper.min.js"></script>
		<script src="{{ asset('public/landing-page') }}/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="{{ asset('public/landing-page') }}/vendor/common/common.min.js"></script>
		<script src="{{ asset('public/landing-page') }}/vendor/jquery.validation/jquery.validate.min.js"></script>
		<script src="{{ asset('public/landing-page') }}/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
		<script src="{{ asset('public/landing-page') }}/vendor/jquery.gmap/jquery.gmap.min.js"></script>
		<script src="{{ asset('public/landing-page') }}/vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
		<script src="{{ asset('public/landing-page') }}/vendor/isotope/jquery.isotope.min.js"></script>
		<script src="{{ asset('public/landing-page') }}/vendor/owl.carousel/owl.carousel.min.js"></script>
		<script src="{{ asset('public/landing-page') }}/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
		<script src="{{ asset('public/landing-page') }}/vendor/vide/jquery.vide.min.js"></script>
		<script src="{{ asset('public/landing-page') }}/vendor/vivus/vivus.min.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="{{ asset('public/landing-page') }}/js/theme.js"></script>
		
		<!-- Current Page Vendor and Views -->
		<script src="{{ asset('public/landing-page') }}/vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
		<script src="{{ asset('public/landing-page') }}/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

		<!-- Current Page Vendor and Views -->
		<script src="{{ asset('public/landing-page') }}/js/views/view.contact.js"></script>

		<!-- Demo -->
		<script src="{{ asset('public/landing-page') }}/js/demos/demo-digital-agency-2.js"></script>

		<!-- Theme Custom -->
		<script src="{{ asset('public/landing-page') }}/js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="{{ asset('public/landing-page') }}/js/theme.init.js"></script>

		<script async="" src="https://static.codepen.io/assets/embed/ei.js"></script>


		 {{-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information. --}}
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
			ga('create', 'UA-12345678-1', 'auto');
			ga('send', 'pageview');
		</script>
		 
		<script>
			$(document).ready(function(){
				$('.tp-loader').hide();
			});
		</script>
		
		<script>
			$('.active-on-click').click(function(){
				// alert('active');
				$('.active-on-click').removeClass('active');
				$(this).addClass('active');
			});
		</script>

		<script>
			function goBack() {
				window.history.back();
			}
		</script>

		@yield('script')

	</body>
</html>
@extends('frontend.layouts.landingPage')
@section('title', 'Online Math Tutoring | MATHNUSA')
@section('css')
<style>
	html {
		scroll-behavior: smooth;
	}

	.pointer {
		cursor: pointer;
	}

	.txt-eclip {
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}

	.text-decoration-none {
		text-decoration: none !important;
	}

	.star-bg,
	.fa-star-half-alt,
	.far {
		color: #e41645;
		font-size: 11px;
	}

	.cus-hig-us-plan {
		display: -webkit-box;
		max-width: 100%;
		-webkit-line-clamp: 3;
		-webkit-box-orient: vertical;
		overflow: hidden;
		text-overflow: ellipsis;
		min-height: 35px;
	}

	.cust-scrool {
		max-height: 100vh !important;
		overflow-y: auto;
		overflow-x: hidden;
	}

	.cust-scrool::-webkit-scrollbar {
		display: none;
	}

	@media (max-width: 1199px) and (min-width:992px) {
		/* .custom-cards {
    			margin-top: -345px !important;
			} */
	}

	a:hover {
		color: #0056b3;
		text-decoration: none;
	}
</style>
@endsection

@section('content')
<div role="main" class="main" id="main">

	<div class="slider-container bg-color-dark rev_slider_wrapper p-relative overflow-visibile" style="height: 991px;">
		<span class="custom-circle custom-circle-1 bg-color-light custom-circle-blur appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="100"></span>
		<span class="custom-circle custom-circle-2 bg-color-primary appear-animation" data-appear-animation="zoomIn" data-appear-animation-delay="200"></span>
		<span class="custom-circle custom-circle-3 bg-color-primary appear-animation" data-appear-animation="zoomIn" data-appear-animation-delay="300"></span>
		<span class="custom-circle custom-circle-1 bg-color-light custom-circle-blur appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="400"></span>
		<span class="custom-circle custom-circle-2 bg-color-primary appear-animation" data-appear-animation="zoomIn" data-appear-animation-delay="500"></span>
		<span class="custom-circle custom-circle-3 bg-color-primary appear-animation" data-appear-animation="zoomIn" data-appear-animation-delay="600"></span>
		<div id="revolutionSlider" class="slider rev_slider manual" data-version="5.4.8" style="height: 991px;">
			<div class="container pt-5 mt-5">
				<div class="row align-items-center pt-3">
					<div class="col-lg-5 mb-5">
						<h1 class="font-weight-bold text-11 line-height-2 mb-3 mt-5 appear-animation animated fadeInUpShorter " data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400" data-appear-animation-duration="750" style="animation-delay: 400ms; color:#fff !important">Online Math Tutoring with Real Results
							<span class="appear-animation animated fadeInRightShorter appear-animation-visible" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="600" data-appear-animation-duration="800" style="animation-delay: 600ms;">
								<span class="d-inline-block text-primary highlighted-word highlighted-word-rotate highlighted-word-animation-1 alternative-font-3 font-weight-bold m-2" style="font-size: 20px; padding-bottom: 5px;">MATHNUSA</span>
							</span>
						</h1>
						<p class="custom-font-size-1 appear-animation animated fadeInUpShorter appear-animation-visible" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="900" data-appear-animation-duration="750" style="animation-delay: 900ms; color:#eee !important">
							Give your kids the gift of online math tutoring from the platform designed to enhance math learning and yield real-world results and improvements.

						<p class="custom-font-size-1 appear-animation animated fadeInUpShorter appear-animation-visible" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="900" data-appear-animation-duration="750" style="animation-delay: 900ms; color:#eee !important">
							Boost your child’s math prowess with the ultimate virtual classroom experience for better teaching and learning
						</p>
						</p>


						<a class="video-open lightbox d-block text-color-light appear-animation animated fadeInUpShorter appear-animation-visible" href="#popup-content-1" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1100" data-appear-animation-duration="1100" data-plugin-options="{'type':'inline'}" style="animation-delay: 1100ms;">
							<div class="video-open-icon"></div> Play Video
						</a><br>

						<a href="#ourServices" data-hash="" data-hash-offset="120" class="text-color-light font-weight-semibold text-1 d-block appear-animation animated fadeInUpShorter appear-animation-visible" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1100" data-appear-animation-duration="1100" data-plugin-options="{'type':'inline'}" style="animation-delay: 2100ms;">
							VIEW MORE <i class="fa fa-long-arrow-alt-right ml-1"></i>
						</a>
						<div id="popup-content-1" class="dialog dialog-lg zoom-anim-dialog rounded p-3 mfp-close-out mfp-hide">
							<div class="embed-responsive embed-responsive-4by3">
								<video width="100%" height="100%" autoplay="" muted="" loop="" controls="controls">
									<source src="{{ asset('frontend/landing-page/video/Intro.mp4')}}" type="video/mp4">
								</video>
							</div>
						</div>
					</div>
					<div class="col-lg-6 offset-lg-1 mb-5 appear-animation animated fadeIn appear-animation-visible" data-appear-animation="fadeIn" data-appear-animation-delay="600" data-appear-animation-duration="750" style="animation-delay: 1200ms;">
						<div class="border-width-10 border-color-light clearfix border border-radius">
							<video class="float-left" width="100%" height="100%" autoplay="" muted="" loop="">
								<source src="{{ asset('frontend/landing-page/video/Intro.mp4')}}" type="video/mp4">
							</video>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<section class="custom-cards p-relative mb-5 pb-5 z-index-2 ">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-custom-cards ">
					<div class="card border-0 bg-color-dark rounded-0 z-index-1 p-5 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="100">
						<div class="card-body d-flex flex-column justify-content-center align-items-center p-0 my-3">
							<img src="{{ asset('frontend/landing-page') }}/images/icons/weekly-session-new.svg" alt="Solution" class="mb-5 svg-icon">
							<h4 class="card-title custom-text-8 font-weight-bold text-color-light text-center mb-3">LIVE WEEKLY SESSIONS</h4>
							<p class="card-text text-center custom-text-4 font-weight-lighter">The virtual math classroom that supplements your child’s daily education anytime, anyplace. Our online tutoring platform engages students without the hassle of parental homeschooling.</p>
							<a href="#ourWork" data-hash="" data-hash-offset="120" class="text-color-light font-weight-semibold text-1 d-block">
								LEARN MORE <i class="fa fa-long-arrow-alt-right ml-1"></i>
							</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-custom-cards ">
					<div class="card border-0 bg-color-primary rounded-0 z-index-1 p-5 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="200">
						<div class="card-body d-flex flex-column justify-content-center align-items-center p-0 my-3">
							<img src="{{ asset('frontend/landing-page') }}/images/icons/peer-to-peer.svg" alt="Solution" class="mb-5 svg-icon">
							<h4 class="card-title custom-text-8 font-weight-bold text-color-light text-center mb-3">PEER TO PEER TUTORING</h4>

							<p class="card-text text-center custom-text-4 font-weight-lighter text-color-light">Increase students’ comfort level and motivation to learn Math. You’ll be surprised at how your kids improve with peer tutoring from our Intelligent Tutors waiting to help them excel.</p>
							<a href="{{ route('peer.tutoring') }}" data-hash="" data-hash-offset="120" class="text-color-light font-weight-semibold text-1 d-block">
								LEARN MORE <i class="fa fa-long-arrow-alt-right ml-1"></i>
							</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-custom-cards">
					<div class="card border-0 bg-color-dark rounded-0 z-index-1 p-5 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="300">
						<div class="card-body d-flex flex-column justify-content-center align-items-center p-0 my-3">
							<img src="{{ asset('frontend/landing-page') }}/images/icons/gamification.svg" alt="Solution" class="mb-5 svg-icon">
							<h4 class="card-title custom-text-8 font-weight-bold text-color-light text-center mb-3">GAMIFICATION </h4>
							<p class="card-text text-center custom-text-4 font-weight-lighter">Learning Math doesn’t have to be a repetitive process. We’ve paired your kid’s favorite games – Fortnite and Monopoly – for a fun learning experience that improves knowledge retention. </p>
							<a href="{{ url('mathnopoly') }}" data-hash="" data-hash-offset="120" class="text-color-light font-weight-semibold text-1 d-block">
								LEARN MORE <i class="fa fa-long-arrow-alt-right ml-1"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

</div>
<!-- <div id="ourServices" style="height:100px"></div>  -->
<section class="our-services p-relative pt-5 mt-5 position-relative cus-our-serv">
	<div class="container pt-5">
		<div class="row py-4 mb-2">
			<div class="col-md-12 order-2">
				<div class="overflow-hidden">
					<h2 class="text-color-dark font-weight-bold text-8 mb-0 pt-0 mt-0 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200">
						MATHNUSA is the Perfect Online Companion for Math Education
						<span class="appear-animation animated fadeInRightShorter appear-animation-visible" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="300" data-appear-animation-duration="400" style="animation-delay: 600ms;">
							<span class="d-inline-block text-primary highlighted-word   alternative-font-3 font-weight-bold text-1">
								The Smarter Way to Learn Math
							</span>
						</span>
					</h2>
				</div>
				<div class="overflow-hidden mb-3">


				</div>
				<p class="appear-animation custom-text-4" data-appear-animation="fadeInUpShorter">
					Math education can be daunting if students aren’t engaged in the process. And it shouldn’t require you to be teaching your kids either if it’s online learning. Let’s get supplemental tutoring back to its classroom days with better online support and teacher guidance.
				</p>
				<p class="appear-animation pb-3 custom-text-4" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="700">
					MATHNUSA is the online math tutoring platform that engages students without the need for active parental tutoring. We do all the work. Your kids learn faster and enjoy the process more. [ <a href="#aboutUs" data-hash="" data-hash-offset="120">About MATHNUSA</a> ]
				</p>

				<section class="our-work overflow-hidden mb-4" data-appear-animation="fadeInUpShorter">
					<div class="container-fluid">
						<div class="row bg-color-dark">
							<div class="col-xl-12 px-0">
								<div class="sort-destination w-100">
									<div class="row  m-0 isotope-item brand-and-identity content-strategy">
										<div class="col-sm-12 custom-our-work overlay overlay-op-9 p-0">
											<a href="#aboutUs" data-hash="" data-hash-offset="120">
												<img src="{{ asset('frontend/landing-page') }}/images/our-services/education.jpg" class="img-fluid">
												<div class=" custom-our-work-text p-5 d-flex align-items-end p-absolute bottom-0">
													<div class="text-left p-relative z-index-2 mb-3">
														<span class="custom-text-4 font-weight-semibold m-0 p-0 text-color-light custom-btn-with-arrow custom-btn-with-arrow-primary text-decoration-none">Find Out More</span>
													</div>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>

				<div class="overflow-hidden text-center">
					<h2 class="text-color-dark font-weight-bold text-8 mb-0 pt-0 mt-0 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="700">
						It’s Easier to Study When It’s Fun & You’re Comfortable
					</h2>
				</div>

				<p class="appear-animation text-center custom-text-4" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="700">
					Give your kids the gift that stays with them for a lifetime. MATHNUSA online tutoring teaches kids to reason by discovering ‘why’ Math works, engages them in mathematical discourse, and uses digital manipulatives that enhance at-home learning. <br>
					[ <a href="#ourServices" data-hash="" data-hash-offset="120">Register for Covid 19 Workshop</a> ]
					[ <a href="#ourServices" data-hash="" data-hash-offset="120">Subscribe to Weekly Classes </a> ]
				</p>
			</div>
		</div>
	</div>
</section>

<section class="our-approach py-5 mb-4 mb-xl-5 mt-4 mt-xl-0 p-relative z-index-1" id="ourServices">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-xl-4 d-flex flex-column justify-content-center align-items-start">
				<h4 class="custom-text-10 mb-4 pb-2 font-weight-bolder custom-title-with-icon custom-title-with-icon-primary appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="100">Our Services</h4>
				<p class=" custom-text-4 line-height-6 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="200">
					At MATHNUSA, your child will experience all the positivity of school online. From teaching and learning to socialization and relationship building, they’re having the full classroom experience, but virtually. They get live class sessions, after-class tutoring, free tutorials, and gamified learning.

				</p>
				<a href="{{ route('our.services') }}" class="btn btn-outline custom-btn-outline btn-light border-0 rounded-0 text-color-primary custom-text-4 font-weight-bolder custom-btn-with-arrow bg-transparent p-0 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="600">Find Out More</a>

			</div>

			<div class="col-lg-4 py-4 py-lg-0">
				<div class="approach-img bg-color-dark" style="background-size:cover">
					<div class="custom-circle custom-circle-1"></div>
					<div class="custom-circle custom-circle-2 bg-color-dark"></div>
					<span class="custom-circle custom-circle-our-approach-deco-1 bg-color-tertiary p-absolute d-block appear-animation" data-appear-animation="zoomIn" data-appear-animation-delay="100"></span>
					<span class="custom-circle custom-circle-our-approach-deco-2 bg-color-tertiary p-absolute d-block appear-animation" data-appear-animation="zoomIn" data-appear-animation-delay="100"></span>
					<span class="custom-circle custom-circle-our-approach-deco-3 bg-color-tertiary p-absolute d-block appear-animation" data-appear-animation="zoomIn" data-appear-animation-delay="100"></span>
				</div>
			</div>
			<div class="col-lg-6 col-xl-4 d-flex align-items-center mt-4 mt-lg-0">
				<ul class="custom-list list-unstyled ml-xl-2 pl-xl-1">
					<li class="custom-text-4 mb-4 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="200">
						<b>Online Tutoring:</b> Experience the better way to learn Math for Grades 3-9 virtually. In-depth face-to-face online classes, trained tutors, passion-filled classes. (Grades 10-12 coming soon).
					</li>
					<li class="custom-text-4 mb-4 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="400"><b>Live Classes:</b> Live classes that supplement classroom education for faster math learning. Students can enroll in our flagship 6-week intensive or our shorter 3-week program.
					</li>
					<li class="custom-text-4 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="600"><b>MATHNOPOLY:</b> Bring math to life with our gamified approach. A combination of Monopoly and Fortnite, our math “game” teaches and assesses students while they have fun.
					</li>
					<li class="custom-text-4 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="800"><b>Peer Tutoring:</b> Give your kids a boost with peer-to-peer tutoring. We partner kids with other high achievers to motivate them and get them active in their learning of math.</li>
					<li class="custom-text-4 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="1000">
						<b>Teacher Development:</b> Professional development opportunities for young teachers who are passionate about supporting student growth and want to join the teaching profession.
					</li>
					<li class="custom-text-4 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="1200">
						<b>Free Math Tutorial Videos:</b> Start your kids learning right away with our free online tutorials. They are pre-recorded and available to watch and learn anytime, anywhere.
					</li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-xl-12 d-flex flex-column justify-content-center align-items-start">
				<div class="overflow-hidden mb-3 w-100">

					{{-- <div class="overflow-hidden">
								<h2 class="text-color-dark font-weight-bold text-8 mb-0 pt-0 mt-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="300">Have you booked your child’s spot yet?</h2>
							</div>
							<p class="appear-animation custom-text-4 " data-appear-animation="fadeInUpShorter" data-appear-animation-delay="700">
								Spaces are filling up fast. And we would love to help every student improve their math skills – we really are that passionate. But we know that to give the best results, we have to limit intake – especially with our live classes. So, get in before it’s too late and save the next space for your math prodigy in the making. [ <a href="{{ route('our.services') }}">Choose a Class</a> ]
					</p><br> --}}
					<div class="overflow-hidden text-center">
						<h2 class="text-color-dark font-weight-bold text-8 mb-0 pt-0 mt-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="300">Set Your Sights on Math Prowess & Progress</h2>
					</div>
					<p class="appear-animation text-center custom-text-4" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="700">
						Online math tutoring delivered virtually in live and pre-recorded sessions that support both student education and teacher growth.
					</p>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="overflow-hidden text-center">
					<h2 class="text-color-dark font-weight-bold text-5 mb-0 pt-0 mt-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="300">Parents</h2>
				</div>
				<p class="appear-animation text-center custom-text-4 " data-appear-animation="fadeInUpShorter" data-appear-animation-delay="700">
					Develop your kid’s everyday logic, reasoning, and problem-solving skills through Math. <br>
					<a href="{{ route('our.services') }}" data-hash="" data-hash-offset="120" class="text-primary font-weight-semibold text-1 d-block">
						LEARN MORE <i class="fa fa-long-arrow-alt-right ml-1"></i>
					</a>
				</p>
			</div>
			<div class="col-lg-4">
				<div class="overflow-hidden text-center ">
					<h2 class="text-color-dark font-weight-bold text-5 mb-0 pt-0 mt-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="300">Teachers</h2>
				</div>
				<p class="appear-animation text-center custom-text-4 " data-appear-animation="fadeInUpShorter" data-appear-animation-delay="700">
					Gain practical virtual student teaching experience that supports classroom learning.
					<a href="#footer" data-hash="" data-hash-offset="120" class="text-primary font-weight-semibold text-1 d-block">
						LEARN MORE <i class="fa fa-long-arrow-alt-right ml-1"></i>
					</a>
				</p>
			</div>
			<div class="col-lg-4">
				<div class="overflow-hidden text-center">
					<h2 class="text-color-dark font-weight-bold text-5 mb-0 pt-0 mt-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="300">School Leaders</h2>
				</div>
				<p class="appear-animation text-center custom-text-4" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="700">
					Develop your classroom math capacity with MATHNUSA or train in-house math teachers.
					<a href="#footer" data-hash="" data-hash-offset="120" class="text-primary font-weight-semibold text-1 d-block">
						LEARN MORE <i class="fa fa-long-arrow-alt-right ml-1"></i>
					</a>
				</p>
			</div>
		</div>
	</div>
	{{-- <div id="ourWork"></div> --}}
</section>

<section class="our-work overflow-hidden" id="">
	<div class="container-fluid">
		<div class="row bg-color-dark">
			<div class="col-xl-9 px-0">
				<div class="sort-destination w-100 cust-scrool" data-sort-id="portfolio">
					{{-- <div class="row w-100 m-0 isotope-item pricing-plan social-media-ads">
								<div class="col-sm-12 custom-our-work overlay overlay-op-9 overlay-show p-0">
									<div class="text-left p-relative z-index-3 py-5 px-4" >
										<div class="card-group text-center mb-3">
											@foreach ($packages->take(4) as $package)
												<div class="card overflow-hidden" style=" outline:1px solid #ededed">
													<span class="card-grade-us">{{ $package->grade->name }}</span>
					<div class="card-header bg-primary text-white text-uppercase">
						{{ $package->title }}
					</div>
					<div class="card-body bg-light-silver" style="max-height: 109px">
						<h5 class="card-title"></h5>
						<p class="card-text h3 text-black">
							{{ App\Models\User::countrySpecificAmount($package) }}
							<small style="font-size:12px" class="text-black">{{ App\Models\User::countrySpecificSymbol() }}</small>
						</p>
					</div>

					<ul class="list-group list-group-flush">
						<li class="cus-hig-us-plan" style="border-bottom: 1px solid rgba(0, 0, 0, .125); border-top: 1px solid rgba(0, 0, 0, .125);">
							There are {{ $package->courses->count()}} courses in this package. Click on view details to see details
						</li>
					</ul>
					<p class="mt-2 mb-1">
						<a href="{{ route('dashboard.packages.courses', $package->id) }}" data-hash="" data-hash-offset="120" class="text-primary font-weight-semibold text-1 d-block">
							VIEW DETAILS <i class="fa fa-long-arrow-alt-right ml-1"></i>
						</a>
					</p>
					<div class="card-body px-2 pt-2 pb-3">
						@if (Auth::check())
						@if (Auth::user()->packages->contains($package->id))
						<h4 class=" cus-curs-txt btn-lg text-success mb-0 pr-0 pb-0">Purchased</h4>
						@else
						<form action="{{ route('payment') }}" method="POST">
							@csrf
							<input type="hidden" name="type" value="{{ App\Models\Plan::PACKAGE }}">
							<input type="hidden" name="package_id" id="package_id" value="{{ $package->id }}">
							<button type="submit" class="btn btn-primary cus-curs-btn btn-lg text-2 text-uppercase">Buy</button>
						</form>
						@endif
						@else
						<form action="{{ route('payment') }}" method="POST">
							@csrf
							<input type="hidden" name="type" value="{{ App\Models\Plan::PACKAGE }}">
							<input type="hidden" name="package_id" id="package_id" value="{{ $package->id }}">
							<button type="submit" class="btn btn-primary cus-curs-btn btn-lg text-2 text-uppercase">Buy</button>
						</form>
						@endif
					</div>
				</div>
				@endforeach
			</div>
			<div class="row">
				<div class="col-4">
					<h4 class="text-color-light custom-text-9 font-weight-bolder text-decoration-none mb-2">Learning Modules</h4>
				</div>
				<div class="col-8 text-right">
					<a href="{{ route('dashboard.packages') }}" class="btn btn-outline custom-btn-outline btn-light border-0 rounded-0 text-color-white custom-text-4 font-weight-bolder p-0">
						<span class="custom-text-4 font-weight-semibold m-0 p-0 text-color-light custom-btn-with-arrow custom-btn-with-arrow-primary text-decoration-none">View All </span>
					</a>
				</div>
			</div>
		</div>
	</div>
	</div> --}}

	@foreach ($grades as $grade)
	<div class="row w-100 m-0 isotope-item {{ $grade->name }} social-media-ads">
		<div class="col-sm-12 custom-our-work overlay overlay-op-9 overlay-show p-0">
			<div class="text-left p-relative z-index-3 py-5 px-4">
				<div class="card-group text-center mb-3">
					@foreach ($grade->courses->where('end_date', '>', date('Y-m-d'))->where('status',App\Models\Course::ACTIVE)->take(4) as $course)

					<div class="col-sm-6 col-md-3 bg-light p-0 mb-2 overflow-hidden grade" style="outline:1px solid #ededed">
						<a href="{{ route('dashboard.course.sections', $course->id) }}">
							<img src="{{ asset('frontend/courses_images/'.$course->image) }}" class="card-img-top" alt="..." style="min-height:0px">
							<div class="col-12">
								<div class="card-body py-2 px-2 text-left">
									<h5 class="card-title mb-0 txt-eclip">{{ $course->title }}</h5>

									<p class="mb-0"><strong>{{ $course->user->first_name }}</strong></p>
									<h5 class="mb-0"><strong class="pr-2">{{ $course->averageRating() }}</strong>
										@for ($i = 1; $i <= 5; $i++) @if ($i <=$course->averageRating())
											<i class="fas fa-star star-bg"></i>
											@else
											<i class="far fa-star"></i>
											@endif
											@endfor
											<small class="px-1">({{ $course->ratings()->count() }})</small>
									</h5>
								</div>
							</div>
							<ul class="list-group list-group-flush">
								<span></span>
								<li class="list-group-item float-right">
									<table cellpadding="5" class="w-100">
										<tr>
											<th class="text-left">Category</th>
											<td class="text-right">{{ $course->category->name }}</td>
										</tr>
										<tr>
											<th class="text-left">Price</th>
											<td class="text-right">
												{{ App\Models\User::countrySpecificAmount($course) }}
												<small style="font-size:12px" class="text-black">{{ App\Models\User::countrySpecificSymbol() }}</small>
											</td>
										</tr>
										<tr>
											<th class="text-left">Start Date</th>
											<td class="text-right">{{$course->start_date}}</td>
										</tr>
										<tr>
											<th class="text-left">End Date</th>
											<td class="text-right">{{$course->end_date}}</td>
										</tr>
									</table>
								</li>
							</ul>
						</a>
					</div>
					@endforeach
				</div>
				<div class="row">
					<div class="col-4">
						<h4 class="text-color-light custom-text-9 font-weight-bolder text-decoration-none mb-2">{{ $grade->name }} Grade</h4>
					</div>
					<div class="col-8 text-right">
						@if (!$grade->courses->isEmpty())
						<a href="{{ route('dashboard.all.courses', $grade->id) }}" class="btn btn-outline custom-btn-outline btn-light border-0 rounded-0 text-color-white custom-text-4 font-weight-bolder p-0">
							<span class="custom-text-4 font-weight-semibold m-0 p-0 text-color-light custom-btn-with-arrow custom-btn-with-arrow-primary text-decoration-none">View All </span>
						</a>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	@endforeach

	<div class="row  m-0 isotope-item content-strategy">
		<div class="col-sm-12 custom-our-work overlay overlay-op-9 overlay-show p-0">
			<a href="#" class="d-block">
				<img src="{{ asset('frontend/landing-page') }}/img/demos/digital-agency-2/bg/bg-8.jpg" class="">
				<div class=" custom-our-work-text p-5 d-flex align-items-end p-absolute bottom-0">
					<div class="text-left p-relative z-index-2 mb-3">
						<h4 class="text-color-light custom-text-9 font-weight-bolder text-decoration-none mb-2">Have you booked your child’s spot yet?</h4>
						<p class="text-uppercase custom-text-4 text-color-quaternary text-decoration-none mb-3">Spaces are filling up fast. And we would love to help every student improve their math skills – we really are that passionate. But we know that to give the best results, we have to limit intake – especially with our live classes. So, get in before it’s too late and save the next space for your math prodigy in the making. </p>
						<span class="custom-text-4 font-weight-semibold m-0 p-0 text-color-light custom-btn-with-arrow custom-btn-with-arrow-primary text-decoration-none">View Work</span>
					</div>
				</div>
			</a>
		</div>
	</div>

	</div>
	</div>
	<div class="col-xl-3 bg-color-dark px-xl-0 sticky-container" id="ourWork">
		<div id="sidebar" class="side-menu-our-work sidebar">
			<div class="py-5 my-2 pl-5 pr-0">
				<h4 id="our-work" class="text-color-light custom-text-10 font-weight-bolder custom-title-with-icon custom-title-with-icon-primary">Our Work</h4>
				<ul class="list-unstyled sort-source custom-text-4 " data-sort-id="portfolio" data-option-key="filter">
					<li class="nav-item active" data-option-value="*">
						<a href="#ourWork" data-hash data-hash-offset="100" class="text-color-quaternary text-color-hover-light text-decoration-none mb-2 py-0 d-block">View All</a>
					</li>
					{{-- <li class="nav-item" data-option-value=".pricing-plan">
										<a href="#ourWork" data-hash data-hash-offset="100" class="text-color-quaternary text-color-hover-light text-decoration-none mb-2 py-0 d-block">Pricing Plan</a>
									</li> --}}
					@foreach ($grades as $grade)
					<li class="nav-item" data-option-value=".{{ $grade->name }}">
						<a href="#ourWork" data-hash data-hash-offset="100" class="text-color-quaternary text-color-hover-light text-decoration-none mb-2 py-0 d-block fetch-courses" data-id="{{$grade->id}}">{{ $grade->name }} Grade</a>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
	</div>
	</div>
</section>

<div id="justAsk"></div>
<section class="section custom-angled section-angled bg-dark border-top-0 pb-0 pb-lg-5 mb-5 mb-lg-0" data-appear-animation="fadeInUpShorter">
	<div class="section-angled-layer-top bg-light"></div>
	<div class="section-angled-layer-bottom bg-light d-none d-lg-block"></div>
	<div class="section-angled-content mb-0 mb-lg-5">
		<div class="container py-5 container-lg custom-container">
			<div class="row align-items-center justify-content-center pt-5 pb-lg-5">
				<div class="col-md-6 col-xl-6 mb-md-5 mb-xl-4">
					<div class="position-relative">
						<div class="row">
							<div class="col-6">
								<img src="{{ asset('frontend/landing-page') }}/img/demos/construction-2/about-us/about-girl.png" class="img-fluid custom-img border-radius-0 max-w-90 appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="600ms" alt="">
							</div>
							<div class="col-6">
								<img src="{{ asset('frontend/landing-page') }}/img/demos/construction-2/about-us/about-boy.png" class="img-fluid custom-img border-radius-0 max-w-90 appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="600ms" alt="">
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-6 mt-lg-5 mt-xl-0" data-appear-animation="fadeInUpShorter">
					<div class="pl-md-4 mt-5">
						<div class="row">
							<div class="col">
								<p class="mb-1">JUST ASK IT</p>
								<h3 class="text-light font-weight-bold text-capitalize text-7 mb-2">Peer-to-Peer Math Tutoring </h3>
							</div>
						</div>
						<div class="row">
							<div class="col">

								<span class="appear-animation animated fadeInRightShorter appear-animation-visible" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="600" data-appear-animation-duration="800">
									<span class="d-inline-block text-primary highlighted-word   alternative-font-3 font-weight-bold text-1 custom-text-6">
										Increase your kids’ motivation to learn mathematics with peer-to-peer tutoring.
									</span>
								</span>
								<p class="mb-3 custom-text-4">
									Peer tutoring inspires higher academic achievement and better interpersonal skills. Students are more motivated and engaged when they learn from each other in and outside the classroom. In our Just ask I.T. (Intelligent Tutors) program, we pair students with other top performers for structured learning sessions.
								</p>
								<p class="mb-3 custom-text-4">
									Qualify for 2 days of free peer tutoring from one of our Just Ask I.T. tutors when you sign up for one of our lesson modules.
								</p>
								<p class="font-weight-bold mb-3">
									<a href="#" class="link-hover-style-1 text-color-primary">READ MORE+</a>
								</p>
								<div class="row mb-4 counters counters-sm text-secondary">
									<div class="col-6 col-lg-3 mb-4 mb-lg-0 mt-4">
										<div class="counter">
											<strong data-to="35" data-append="+">35+</strong>
											<label class="text-3 pt-1">Business Year</label>
										</div>
									</div>
									<div class="col-6 col-lg-3 mb-4 mb-lg-0 mt-4">
										<div class="counter">
											<strong data-to="240" data-append="+">240+</strong>
											<label class="text-3 pt-1">Satisfed Clients</label>
										</div>
									</div>
									<div class="col-6 col-lg-3 mb-4 mb-sm-0 mt-4">
										<div class="counter">
											<strong data-to="2000" data-append="+">2000+</strong>
											<label class="text-3 pt-1">Successfull Cases</label>
										</div>
									</div>
									<div class="col-6 col-lg-3 mt-4">
										<div class="counter">
											<strong data-to="130" data-append="+">130+</strong>
											<label class="text-3 pt-1">Pro Consultants</label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div id="wallOfFame"></div>
<section class="our-services p-relative py-5 mb-5" data-appear-animation="fadeInUpShorter" style="background-color: #fff">
	<span class="custom-circle custom-circle-2 bg-color-quaternary appear-animation" data-appear-animation="zoomIn" data-appear-animation-delay="100"></span>
	<div class="container">
		<div class="row justify-content-center">
			<h4 class="text-color-dark custom-text-10 font-weight-bolder text-center custom-title-with-icon-center pb-5 mb-4 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200">Meet our top student performers at MATHNUSA</h4>
		</div>
		<div class="row">
			<div class="col-md-4 mb-4">
				<div class="portfolio-item">
					<a href="#">
						<span class="thumb-info thumb-info-no-borders thumb-info-lighten thumb-info-bottom-info thumb-info-bottom-info-dark thumb-info-bottom-info-show-more thumb-info-no-zoom border-radius-0">
							<span class="thumb-info-wrapper">
								<img src="{{ asset('frontend/landing-page/images/wall-of-fame/1.jpg') }}" class="img-fluid" alt="">
								<span class="thumb-info-title bg-transparent p-4">
									<span class="thumb-info-inner line-height-1 text-4 font-weight-bold">The Desk</span>
									<span class="thumb-info-type opacity-6">Websites</span>
									<br>
									<span class="custom-text-4 font-weight-semibold m-0 p-0 text-color-light custom-btn-with-arrow custom-btn-with-arrow-primary text-decoration-none">View More</span>
								</span>

							</span>
						</span>
					</a>
				</div>
			</div>
			<div class="col-md-4 mb-4">
				<div class="portfolio-item">
					<a href="#">
						<span class="thumb-info thumb-info-no-borders thumb-info-lighten thumb-info-bottom-info thumb-info-bottom-info-dark thumb-info-bottom-info-show-more thumb-info-no-zoom border-radius-0">
							<span class="thumb-info-wrapper">
								<img src="{{ asset('frontend/landing-page/images/wall-of-fame/2.jpg') }}" class="img-fluid" alt="">
								<span class="thumb-info-title bg-transparent p-4">
									<span class="thumb-info-inner line-height-1 text-4 font-weight-bold">The Desk</span>
									<span class="thumb-info-type opacity-6">Websites</span>
									<br>
									<span class="custom-text-4 font-weight-semibold m-0 p-0 text-color-light custom-btn-with-arrow custom-btn-with-arrow-primary text-decoration-none">View More</span>
								</span>
							</span>
						</span>
					</a>
				</div>
			</div>
			<div class="col-md-4 mb-4">
				<div class="portfolio-item">
					<a href="#">
						<span class="thumb-info thumb-info-no-borders thumb-info-lighten thumb-info-bottom-info thumb-info-bottom-info-dark thumb-info-bottom-info-show-more thumb-info-no-zoom border-radius-0">
							<span class="thumb-info-wrapper">
								<img src="{{ asset('frontend/landing-page/images/wall-of-fame/3.jpg') }}" class="img-fluid" alt="">
								<span class="thumb-info-title bg-transparent p-4">
									<span class="thumb-info-inner line-height-1 text-4 font-weight-bold">The Desk</span>
									<span class="thumb-info-type opacity-6">Websites</span>
									<br>
									<span class="custom-text-4 font-weight-semibold m-0 p-0 text-color-light custom-btn-with-arrow custom-btn-with-arrow-primary text-decoration-none">View More</span>
								</span>
							</span>
						</span>
					</a>
				</div>
			</div>
			<div class="col-md-4 mb-4">
				<div class="portfolio-item">
					<a href="#">
						<span class="thumb-info thumb-info-no-borders thumb-info-lighten thumb-info-bottom-info thumb-info-bottom-info-dark thumb-info-bottom-info-show-more thumb-info-no-zoom border-radius-0">
							<span class="thumb-info-wrapper">
								<img src="{{ asset('frontend/landing-page/images/wall-of-fame/4.jpg') }}" class="img-fluid" alt="">
								<span class="thumb-info-title bg-transparent p-4">
									<span class="thumb-info-inner line-height-1 text-4 font-weight-bold">The Desk</span>
									<span class="thumb-info-type opacity-6">Websites</span>
									<br>
									<span class="custom-text-4 font-weight-semibold m-0 p-0 text-color-light custom-btn-with-arrow custom-btn-with-arrow-primary text-decoration-none">View More</span>
								</span>
							</span>
						</span>
					</a>
				</div>
			</div>
			<div class="col-md-4 mb-4">
				<div class="portfolio-item">
					<a href="#">
						<span class="thumb-info thumb-info-no-borders thumb-info-lighten thumb-info-bottom-info thumb-info-bottom-info-dark thumb-info-bottom-info-show-more thumb-info-no-zoom border-radius-0">
							<span class="thumb-info-wrapper">
								<img src="{{ asset('frontend/landing-page/images/wall-of-fame/5.jpg') }}" class="img-fluid" alt="">
								<span class="thumb-info-title bg-transparent p-4">
									<span class="thumb-info-inner line-height-1 text-4 font-weight-bold">The Desk</span>
									<span class="thumb-info-type opacity-6">Websites</span><br>
									<span class="custom-text-4 font-weight-semibold m-0 p-0 text-color-light custom-btn-with-arrow custom-btn-with-arrow-primary text-decoration-none">View More</span>
								</span>
							</span>
						</span>
					</a>
				</div>
			</div>
			<div class="col-md-4 mb-4">
				<div class="portfolio-item">
					<a href="#">
						<span class="thumb-info thumb-info-no-borders thumb-info-lighten thumb-info-bottom-info thumb-info-bottom-info-dark thumb-info-bottom-info-show-more thumb-info-no-zoom border-radius-0">
							<span class="thumb-info-wrapper">
								<img src="{{ asset('frontend/landing-page/images/wall-of-fame/6.jpg') }}" class="img-fluid" alt="">
								<span class="thumb-info-title bg-transparent p-4">
									<span class="thumb-info-inner line-height-1 text-4 font-weight-bold">The Desk</span>
									<span class="thumb-info-type opacity-6">Websites</span>
									<br>
									<span class="custom-text-4 font-weight-semibold m-0 p-0 text-color-light custom-btn-with-arrow custom-btn-with-arrow-primary text-decoration-none">View More</span>
								</span>
							</span>
						</span>
					</a>
				</div>
			</div>
			<div class="col-xl-4 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="200">

			</div>
		</div>
		<div class="row">
			<div class="col-md-12"></div>
		</div>

		<div class="row justify-content-center">
			<div class="col-xl-9">
				<p class="custom-text-4 mt-4 mb-0 text-center appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="400">
					Help us celebrate! Here we showcase our top math students who have done well in their year level. You too can join them. Simply sign up for a live class and experience the immense fun and learning activities that makes MATHNUSA an unforgettable journey to math excellence.
				</p>
			</div>
		</div>
	</div>
</section>

<section class="our-insights bg-color-tertiary p-relative py-5" id="blog">
	<span class="custom-circle custom-circle-2 bg-color-primary appear-animation" data-appear-animation="zoomIn" data-appear-animation-delay="100"></span>
	<span class="custom-circle custom-circle-3 bg-color-primary appear-animation" data-appear-animation="zoomIn" data-appear-animation-delay="100"></span>
	<div class="container py-5">
		<div class="row">
			<div class="col">
				<h4 class="text-color-dark custom-text-10 font-weight-bolder text-center custom-title-with-icon-center custom-title-with-icon custom-title-with-icon-primary pb-5 mb-5 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200">Our Insights</h4>
			</div>
		</div>
		<div class="row">
			<div class="col pb-5">
				<article>
					<p class="custom-font-tertiary text-uppercase custom-text-2 mb-1 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="200">FEBRUARY 4, 2020</p>
					<h4 class="text-color-dark custom-text-8 font-weight-bolder mb-3 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="400"><a href="#" class="text-color-dark text-color-hover-primary">An Interview With John Paul Doe</a></h4>
					<p class="custom-text-4 mb-2 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="600">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed imperdiet libero id nisi euismod, sed porta est consectetur. dolor sit amet, consectetur adipiscing elit. Sed imperdiet libero.</p>
					<a href="#" class="text-color-primary text-color-hover-secondary custom-text-4 font-weight-bolder text-decoration-underline appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="800">Read More...</a>
				</article>
			</div>
		</div>
		<div class="row">
			<div class="col pb-5">
				<article>
					<p class="custom-font-tertiary text-uppercase custom-text-2 mb-1 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="200">FEBRUARY 4, 2020</p>
					<h4 class="text-color-dark custom-text-8 font-weight-bolder mb-3 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="400"><a href="#" class="text-color-dark text-color-hover-primary">Building An E-Commerce Site With CMS</a></h4>
					<p class="custom-text-4 mb-2 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="600">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed imperdiet libero id nisi euismod, sed porta est consectetur. dolor sit amet, consectetur adipiscing elit. Sed imperdiet libero.</p>
					<a href="#" class="text-color-primary text-color-hover-secondary custom-text-4 font-weight-bolder text-decoration-underline appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="800">Read More...</a>
				</article>
			</div>
		</div>
		<div class="row">
			<div class="col pb-5">
				<article>
					<p class="custom-font-tertiary text-uppercase custom-text-2 mb-1 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="200">FEBRUARY 4, 2020</p>
					<h4 class="text-color-dark custom-text-8 font-weight-bolder mb-3 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="400"><a href="#" class="text-color-dark text-color-hover-primary">How To Design Mobile Apps For Everyone</a></h4>
					<p class="custom-text-4 mb-2 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="600">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed imperdiet libero id nisi euismod, sed porta est consectetur. dolor sit amet, consectetur adipiscing elit. Sed imperdiet libero.</p>
					<a href="#" class="text-color-primary text-color-hover-secondary custom-text-4 font-weight-bolder text-decoration-underline appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="800">Read More...</a>
				</article>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<a herf="#" class="btn btn-outline custom-btn-outline btn-primary rounded-0 text-color-dark custom-text-4 bg-color-hover-transparent text-color-hover-light font-weight-semibold custom-btn-with-arrow px-4 py-3 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="400">View More</a>
			</div>
		</div>
	</div>
</section>

<div id="mathnopoly"></div>
<section class="get-in-touch bg-color-after-tertiary bg-color-primary p-relative overflow-hidden" style="background-image: url({{ asset('frontend/landing-page/images/mathnopoly/mathnopoly-3.jpg') }}); background-size:cover">
	<span class="custom-circle custom-circle-1 bg-color-light appear-animation" data-appear-animation="zoomIn" data-appear-animation-delay="100"></span>
	<span class="custom-circle custom-circle-2 bg-color-light appear-animation" data-appear-animation="zoomIn" data-appear-animation-delay="100"></span>
	<div class="container">
		<div class="row">
			<div class="col-lg-8">

				<h4 class="custom-title-with-icon custom-title-with-icon-primary font-weight-bolder custom-text-10 appear-animation text-primary" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="400">
					Test your skills and knowledge in MATHNOPOLY
				</h4>
				<p class="mb-2  custom-text-7  appear-animation text-white" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="200">The ultimate game of learning math is the new way of “Doing Homework.” Choose your grade level and test your math knowledge. </p>
				<a href="{{ route('mathnopoly') }}" class="btn btn-outline custom-btn-outline btn-light border-0 rounded-0 text-color-white custom-text-4 font-weight-bolder custom-btn-with-arrow bg-transparent p-0 appear-animation text-primary" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="600">Find Out More</a>
			</div>
			<div class="col-lg-4 d-flex align-items-center justify-content-start justify-content-lg-end mt-5 mt-lg-0">
				<a herf="#" class="btn btn-outline custom-btn-outline btn-primary rounded-0 text-color-light custom-text-4 bg-color-hover-primary text-color-hover-light font-weight-semibold custom-btn-with-arrow px-4 py-3 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="400">Let's Play</a>
			</div>

		</div>

	</div>
</section>

<section class="p-relative bg-tertiary" id="aboutUs">
	<div class="container pt-5">
		<div class="row py-4">
			<div class="col-md-7 order-2">
				<div class="overflow-hidden">
					<h2 class="text-color-dark font-weight-bold text-8 mb-0 pt-0 mt-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="300">About Us</h2>
				</div>
				<div class="overflow-hidden mb-3">
					<p class="font-weight-bold text-primary text-uppercase mb-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="500">Online tutoring enhanced with traditional classroom benefits</p>
				</div>
				<p class="appear-animation custom-text-4" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="700">
					MATHNUSA is more than another online tutoring website. It is a learning platform designed for your child to enjoy classroom experiences once again. Students can safely socialize, engage, and conduct meaningful discussions about learning and how to reason about math with their peers and teachers.
				</p>
				<p class="appear-animation custom-text-4" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="700">
					We also address the pressing problems facing learning in the post-COVID reality – deep learning from a distance. We relieve parents of the burden of co-teaching with online classes that build self-directed students.
					<br>
					<a href="{{ route('aboutus') }}" class="btn btn-outline custom-btn-outline btn-light border-0 rounded-0 text-color-primary custom-text-4 font-weight-bolder custom-btn-with-arrow bg-transparent p-0 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="600">Find Out More</a>

				</p>

			</div>
			<div class="col-md-5 order-md-2 mb-4 mb-lg-0 appear-animation" data-appear-animation="fadeInRightShorter">
				<img src="{{ asset('frontend/landing-page/images/about-us/aboutus.jpg') }}" class="img-fluid mb-2" alt="">
			</div>
		</div>
	</div>
</section>
</div>
@endsection

@section('script')
{{-- <script>
		$('.fetch-courses').click(function(){
			var id = $(this).data('id');
			$.ajax({
				url:'{{url('ajax/grade/courses')}}/'+id,
success:function(data){
$('#append-courses').html(data);
console.log(data);
}
});
});
</script> --}}
@endsection
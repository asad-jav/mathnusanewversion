<div class="row w-100 m-0 isotope-item {{$grade->name}} social-media-ads">
    <div class="col-sm-12 custom-our-work overlay overlay-op-9 overlay-show p-0">
        <div class="text-left p-relative z-index-3 py-5 px-4" >
            <div class="card-group text-center mb-3">
                @foreach ($courses->take(4) as $course)
                    <div class="col-sm-6 col-md-3 bg-light p-0 mb-2 overflow-hidden grade" style="outline:1px solid #ededed">
                        <img src="{{ asset('public/courses_images/15092020-OJFvoV.jpg') }}" class="card-img-top" alt="..." style="min-height:0px">
                        <div class="col-12">
                            <div class="card-body py-2 px-2 text-left">
                                <a href="{{ route('dashboard.course.sections', $course->id) }}" >
                                    <h5 class="card-title mb-0 txt-eclip">{{ $course->title }}</h5>
                                </a>
                                <p class="mb-0"><strong>{{ $course->user->first_name }}</strong></p>
                                <h5 class="mb-0"><strong class="pr-2">2.5</strong>
                                    <i class="fas fa-star star-bg"></i>
                                    <i class="fas fa-star star-bg"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <small class="px-1">(123,45)</small>
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
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-4">
                    <h4 class="text-color-light custom-text-9 font-weight-bolder text-decoration-none mb-2">3rd Grade</h4>
                </div>
                <div class="col-8 text-right">
                    <a href="#" class="btn btn-outline custom-btn-outline btn-light border-0 rounded-0 text-color-white custom-text-4 font-weight-bolder p-0" >
                        <span class="custom-text-4 font-weight-semibold m-0 p-0 text-color-light custom-btn-with-arrow custom-btn-with-arrow-primary text-decoration-none">View All </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@extends('layouts.admin')
@section('title', 'All Videos')
@section('css')
<style>
    .newst{
        position:relative;
        text-align:right;
        height:420px;
        width:520px;
    }

    #gmap_canvas img {
        max-width:none!important;
        background:none!important
    }    
</style>

@endsection
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
                <h3 class="content-header-title">Videos</h3>
            </div>
        </div>
        <div class="content-body">
            <!-- Header footer section start -->
            <section id="header-footer">
                <div class="row match-height">
                    @foreach ($videos as $video)
                        <div class="col-xl-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $video->title }}</h4>
                                </div>
                                <div class="embed-responsive embed-responsive-item embed-responsive-4by3">
                                    <iframe class="img-thumbnail" src="https://www.youtube.com/embed/{{ $video->link }}?rel=1&amp;controls=1&amp;showinfo=0" allowfullscreen></iframe>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        {{ $video->description }}
                                    </p>
                                    
                                </div>
                                <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">      
                                    <span class="float-left">{{App\User::getCurrentDateDifference($video->created_at)}}</span>
                                    @if (Auth::user()->roles[0]->slug == 'admin')
                                    <span class="tags float-right">
                                        <a href="{{ url('video/edit/'.$video->id) }}" class="card-link"> Edit </a>
                                        <a href="{{ url('video/delete/'.$video->id) }}" class="confirm card-link"> Delete</a>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</div>
<!-- END: Content-->


@endsection
@section('script')
<script>
    // $('.thumbnail').click(function(){
    //     var loc = $(this).data('original');
    //     $('.lightbox').attr('src', loc);
    //     $('#image-preview').modal({
    //         backdrop: 'static',
    //         keyboard: false,
    //     });
    // });
</script>
@endsection

@extends('layouts.landingPage')
@section('title', 'Online Math Tutoring |MATHNUSA')

@section('css')
    <style>
        html{
            scroll-behavior: smooth;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row mb-5">
            <div class="col-lg-12">
                <h1 class="text-center display-4 mt-5">Price Packages</h1>
                <div class="card-group text-center mb-2" >
                    @foreach ($plans as $plan)
                        <form action="{{ route('payment') }}" method="post" id="plan-form-{{ $plan->id }}">
                            @csrf
                            <input type="hidden" name="plan_id" value="{{ $plan->plan_id }}">
                            <input type="hidden" name="amount" value="{{ $plan->amount }}">
                            <input type="hidden" name="interval" value="{{ $plan->plan_interval }}">
                        </form>
                        <div class="card" style="width: 18rem; outline:1px solid #ededed">
                            <div class="card-header bg-secondary text-white" >
                                {{ $plan->title }}
                            </div>
                            <div class="card-body bg-light-silver">
                                <h5 class="card-title"></h5>
                                <p class="card-text h3 text-black" >{{ $plan->amount }}<small style="font-size:12px" class="text-black">$</small>
                                
                                </p>
                            </div>
                            <ul class="list-group list-group-flush">
                                @php
                                    $desc_list = explode(',', $plan->description);
                                @endphp
                                @foreach ($desc_list as $item)
                                    <li class="list-group-item">{{ $item }}</li>
                                @endforeach
                            </ul>
                            <div class="card-body ">
                                <a href="#" class="btn btn-outline-secondary plan" onClick = "event.preventDefault();getElementById('plan-form-{{ $plan->id }}').submit()">CHOOSE PLAN</a>
                            </div>
                        </div>	
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    
@endsection
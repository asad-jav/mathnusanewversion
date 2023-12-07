@extends('layouts.admin')
@section('title', 'Add Plan')
@section('css')
@endsection
@section('content')

<div class="app-content content pt-2 pb-2" style="overflow: scroll;">
    
    <div class="col-12">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Plan </h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <a href="{{ route('plans') }}" class="">< Plan List</a>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <form action="{{ route('plan.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Amount</label>
                            <input type="text" name="amount" id="amount" value="{{ old('amount') }}" class="form-control">
                            @error('amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Currency</label>
                            <input type="text" name="currency" id="currency" value="{{ old('currency') }}" class="form-control">
                            @error('currency')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Plan Interval</label>
                            <input type="text" name="plan_interval" id="plan_interval" value="{{ old('plan_interval') }}" class="form-control">
                            @error('plan_interval')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Interval Count</label>
                            <input type="text" name="interval_count" id="interval_count" value="{{ old('interval_count') }}" class="form-control">
                            @error('interval_count')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Plan ID</label>
                            <input type="text" name="plan_id" id="plan_id" value="{{ old('plan_id') }}" class="form-control">
                            @error('plan_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Product ID</label>
                            <input type="text" name="product_id" id="product_id" value="{{ old('product_id') }}" class="form-control">
                            @error('product_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea type="text" name="description" id="description" value="{{ old('description') }}" rows="5" class="form-control" placeholder="Description"></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
@endsection
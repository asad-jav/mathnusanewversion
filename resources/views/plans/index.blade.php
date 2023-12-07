@extends('layouts.admin')
@section('title', 'All Plans')
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
        @if (Session::has('failure'))
            <div class="alert alert-danger">
                {{ Session::get('failure') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All Plans ({{ $plans->count() }})</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <a href="{{ url('dashboard/plan/create') }}" class=""> Add Plan ></a>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Amount</th>
                                    <th>Currency</th>
                                    <th>Plan Interval</th>
                                    <th>Interval Count</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plans as $plan)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{ $plan->title }}</td>
                                        <td>{{ $plan->amount }}</td>
                                        <td>{{ $plan->currency }}</td>
                                        <td>{{ $plan->plan_interval }}</td>
                                        <td>{{ $plan->interval_count }}</td>
                                        <td>{{ $plan->status }}</td>
                                        <td >
                                            <div class="form-group">
                                                <a href="{{ route('plan.edit', $plan->id) }}" class="">Edit </a>|
                                                <a href="{{ route('plan.delete', $plan->id) }}" class=" confirm"> Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
@endsection
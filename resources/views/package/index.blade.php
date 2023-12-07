@extends('layouts.admin')
@section('title', 'All Packages')
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
                <h4 class="card-title">All Pacakges ({{ $packages->count() }})</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                @if (Auth::user()->roles->contains(App\Models\User::ROLE_ADMIN))
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <a href="{{ route('package.create') }}" class=""> Create Package ></a>
                    </ul>
                </div>
                @endif
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    {{-- <th>Plan</th> --}}
                                    <th>Title</th>
                                    <th>Courses</th>
                                    <th>USD</th>
                                    <th>KWD</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($packages as $package)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        {{-- <td>{{ $package->plan->title }}</td> --}}
                                        <td>{{ $package->title }}</td>
                                        <td>
                                            @foreach($package->courses as $course)
                                                <label for="" class="badge badge-primary">{{ $course->title }}</label>
                                            @endforeach
                                        </td>
                                        <td>{{ $package->amount_in_usd }} USD</td>
                                        <td>{{ $package->amount_in_kwd }} KWD</td>
                                        <td >
                                            @if (Auth::user()->roles->contains(App\Models\User::ROLE_ADMIN))
                                                <div class="form-group">
                                                    <a href="{{ route('package.edit', $package->id) }}" class="">Edit </a>|
                                                    <a href="{{ route('package.delete', $package->id) }}" class=" confirm"> Delete</a>
                                                </div>
                                            @else
                                                <div class="form-group">
                                                    <a href="#" class="">Subscribe </a>
                                                </div>
                                            @endif
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
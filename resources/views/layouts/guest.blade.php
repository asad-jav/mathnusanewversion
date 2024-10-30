@extends('layouts.auth')
@section('title', 'Verify account')
@section('content')
<div class="container">
    <div class="row justify-content-center  pt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

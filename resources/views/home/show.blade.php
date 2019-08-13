@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4 bg-white pt-3">
            @include('../partials/profile_space',['check_user' => Auth::user()])
        </div>
        <div class="col-8">
            <div class="py-3 border bg-gray">
                <h2 class="text-center">Your Activity History</h2>
                @include('../partials/activity_space')
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/users/index.css') }}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-8 bg-white py-4">
            <div class="border-bottom mb-4">
                @include('../partials/user_button')
            </div>
            <div class="row">
                {{-- The case this user doesn't have any follower and is auth --}}
                @if(empty($users->count()) && Auth::user()->id == $user->id)
                    <div class="text-danger text-center mx-auto">
                        <h1>You don't have follower yet</h1>
                        <h2><a href="{{ route('home.show') }}"> >> Return to your profile << </a></h2>
                    </div>
                {{-- The case this user doesn't have any follower and is other --}}
                @elseif(empty($users->count()) && Auth::user()->id != $user->id)
                    <div class="text-danger text-center mx-auto">
                        <h1>The member doesn't have follower yet</h1>
                        <h2><a href="{{ route('user.show', ['user' => $user->id]) }}"> >> Back to this user's page << </a></h2>
                    </div>
                {{-- The case this user has some followers --}}
                @else
                    @include('../partials/user_list')
                @endif
            </div>
            <div class="d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
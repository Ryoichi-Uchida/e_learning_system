@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4 bg-white pt-3">
            <div class="text-center">
                <div class="pb-3 mt-3 border-bottom">
                    <img src="/images/{{ $user->avatar }}" alt="" class="mb-3 avatar">
                    <h2 class="mb-3">{{ $user->name }}</h2>
                    @include('../partials/follow_button')
                </div>
                <div class="p-2 my-3">
                    <div class="row border-bottom pb-3">
                        <div class="col-md-6">
                            <a href="{{ route('user.following', ['user' => $user->id]) }}"><h4>{{ $user->following()->count() }}</h4></a>
                            <h4>Following</h4>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('user.followers', ['user' => $user->id]) }}"><h4>{{ $user->followers()->count() }}</h4></a>
                            <h4>Followers</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class=" py-3 my-3 bg-gray">
                                <a href=""><h4>30</h4></a>
                                <h4>Learned Words</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="py-3 border bg-gray">
                <h2 class="text-center">Activity History</h2>
                <div class="bg-white border p-3 m-3">
                    <h4>Following Yuki</h4>
                    <p>2 days ago</p>
                </div>
                <div class="bg-white border p-3 m-3">
                    <h4>learned New words</h4>
                    <p>3 days ago</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

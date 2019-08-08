@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/users/index.css') }}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-8 bg-white py-4">
            <h2 class="pb-4">{{ $one_user->name }}'s following members</h2>
            <div class="row">
                {{-- The case this user doesn't have any following member and is auth --}}
                @if(empty($users->count()) && Auth::user()->id == $one_user->id)
                    <div class="text-danger text-center mx-auto">
                        <h1>You don't have following member yet</h1>
                        <h2><a href="{{ route('user.index') }}"> >> Let's follow someone! << </a></h2>
                    </div>
                {{-- The case this user doesn't have any following member and is other --}}
                @elseif(empty($users->count()) && Auth::user()->id != $one_user->id)
                    <div class="text-danger text-center mx-auto">
                        <h1>The member doesn't have following member yet</h1>
                        <h2><a href="{{ route('user.show', ['user' => $one_user->id]) }}"> >> Back to this user's page << </a></h2>
                    </div>
                {{-- The case this user has any following member --}}
                @else
                    @foreach ($users as $user)
                        <div class="col-6">
                            <div class="user-list border px-3 mx-2 mb-2">
                                <img src="/images/{{ $user->avatar }}" alt="" class="avatar">
                                <a href="{{ route('user.show', ['user' => $user->id]) }}"><p class="px-3 pt-3">{{ $user->name }}</p></a>                          
                                <div class="ml-auto">
                                    @include('../partials/follow_button')
                                </div>   
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
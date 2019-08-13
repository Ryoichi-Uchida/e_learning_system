@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/users/index.css') }}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-8 bg-white py-4">
            <h2 class="pb-4">{{ $user->name }}'s following members</h2>
            <div class="row">
                {{-- The case this user doesn't have any following member and is auth --}}
                @if(empty($users->count()) && Auth::user()->id == $user->id)
                    <div class="text-danger text-center mx-auto">
                        <h1>You don't have following member yet</h1>
                        <h2><a href="{{ route('user.index') }}"> >> Let's follow someone! << </a></h2>
                    </div>
                {{-- The case this user doesn't have any following member and is other --}}
                @elseif(empty($users->count()) && Auth::user()->id != $user->id)
                    <div class="text-danger text-center mx-auto">
                        <h1>The member doesn't have following member yet</h1>
                        <h2><a href="{{ route('user.show', ['user' => $user->id]) }}"> >> Back to this user's page << </a></h2>
                    </div>
                {{-- The case this user has any following member --}}
                @else
                    @include('../partials/user_list')
                @endif
            </div>
            <div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
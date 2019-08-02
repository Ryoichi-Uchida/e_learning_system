@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/users/index.css') }}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-8 bg-white py-4">
            <h2 class="pb-4">All members</h2>
            <div class="row">
                @foreach ($users as $user)
                    <div class="col-6">
                        <div class="user-list border px-3 mx-2 mb-2">
                            <img src="/images/{{ $user->avatar }}" alt="" class="avatar">
                            <a href=""><p class="px-3 pt-3">{{ $user->name }}</p></a>                          
                            <div class="ml-auto">
                                <a href="" class="btn btn-primary">Follow</a>
                            </div>   
                        </div>
                    </div>
                @endforeach
            </div>
            <div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
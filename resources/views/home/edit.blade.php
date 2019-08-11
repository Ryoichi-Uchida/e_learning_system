@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center ">
        <div class="col-10 bg-white ">
            <div class="my-4">
                <div class="title">
                    <h1 class="p-2 mb-4 mx-4 border-bottom">Edit Profile</h1>
                </div>
                <div class="col-6 m-auto">
                    <form action="{{ route('home.update') }}" method="post" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf                    
                        <div class="form-group">
                            <label for="name">◾Name <span class="text-primary">( Current : {{ Auth::user()->name }} )</span></label>
                            <input type="text" value="{{ old('name') }}" class="form-control" name="name">
                            @if ($errors->has('name'))
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">◾E-mail <span class="text-primary">( Current : {{ Auth::user()->email }} )</span></label>
                            <input type="text" value="{{ old('email') }}" class="form-control" name="email">
                            @if ($errors->has('email'))
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="avatar" class="d-block">◾Avatar</label>
                            <input type="file" name="avatar">
                            @if ($errors->has('avatar'))
                                <p class="text-danger">{{ $errors->first('avatar') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="new_password">◾New Password</label>
                            <input type="password" value="" class="form-control" name="new_password">
                            @if ($errors->has('new_password'))
                                <p class="text-danger">{{ $errors->first('new_password') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password_confirm">◾Password Confirm</label>
                            <input type="password" value="" class="form-control" name="new_password_confirmation">
                            @if ($errors->has('password_confirm'))
                                <p class="text-danger">{{ $errors->first('password_confirm') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary float-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
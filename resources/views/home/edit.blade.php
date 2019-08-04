@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center ">
        <div class="col-8 bg-white ">
            <div class="my-4">
                <div class="title">
                    <h1 class="p-2 mb-4 mx-4 border-bottom">Edit Profile</h1>
                </div>

                {{-- Name update --}}
                <div class="d-flex justify-content-center">
                    <form action="{{ route('home.update_name') }}" method="post" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <label for="name">◾Name</label>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" value="{{ Auth::user()->name }}" class="form-control" name="name">
                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Email update --}}
                <div class="d-flex justify-content-center">
                    <form action="{{ route('home.update_email') }}" method="post" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <label for="email">◾E-mil Address</label>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" value="{{ Auth::user()->email }}" class="form-control" name="email">
                                    @if ($errors->has('email'))
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Avatar update --}}
                <div class="d-flex justify-content-center">
                    <form action="{{ route('home.update_avatar') }}" method="post" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <label for="avatar">◾Avatar</label>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="file" name="avatar">
                                    @if ($errors->has('avatar'))
                                        <p class="text-danger">{{ $errors->first('avatar') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Password update --}}
                <div class="d-flex justify-content-center">
                    <form action="{{ route('home.update_password') }}" method="post" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <label for="new_password">◾New Password</label>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="password" value="" class="form-control" name="new_password">
                                    @if ($errors->has('new_password'))
                                        <p class="text-danger">{{ $errors->first('new_password') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <label for="password_confirm">◾Password Confirm</label>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="password" value="" class="form-control" name="new_password_confirmation">
                                    @if ($errors->has('password_confirm'))
                                        <p class="text-danger">{{ $errors->first('password_confirm') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
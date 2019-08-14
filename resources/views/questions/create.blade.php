@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/questions/create.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-10 bg-white">
            <div class="my-4">
                @if (session('status'))
                    <div class="alert alert-success text-center">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="title">
                    <a href="{{ route('category.index') }}" class="btn btn-secondary float-right mr-4">Back to Index</a>
                    <h1 class="p-2 mb-4 mx-4 border-bottom">Add New Question</h1>
                </div>
                <form action="{{ route('question.store',['category' => $category->id]) }}" method="post">
                    @csrf
                    <div class="row form-list">
                        <div class="col-4 mx-auto">
                            <div class="form-group">
                                <h3 class="mb-0">Please input a Question</h3>
                                <span class="text-danger">*Required!</span>
                                <textarea name="question" cols="10" rows="5" class="form-control">{{ old('question') }}</textarea>
                                @if ($errors->has('question'))
                                    <p class="text-danger">{{ $errors->first('question') }}</p>
                                @endif
                            </div>
                        </div>
                        <img src="https://image.flaticon.com/icons/png/512/54/54366.png" alt="">
                        <div class="col-6 m-auto">
                            <h3>Please input Options and an Answer</h3>
                            @if ($errors->has('answer'))
                                <p class="text-danger text-right">{{ $errors->first('answer') }}</p>
                            @endif
                            <div class="questions border px-4 mb-4">

                                <div class="my-3">
                                    <div class="row">
                                        <div class="col-10">
                                            <label>1st Option <span class="text-danger">*Required!</span></label>
                                        </div>
                                        <div class="col-2 pt-1 pl-1">
                                            <h5 class="text-danger">Answer</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-10">
                                            <input type="text" name="option1" class="form-control" value="{{ old('option1') }}">
                                            @if ($errors->has('option1'))
                                                <p class="text-danger">{{ $errors->first('option1') }}</p>
                                            @endif
                                        </div>
                                        <div class="col-2 text-center pt-1">
                                            <input type="radio" name="answer" value="option1">
                                        </div>
                                    </div>
                                </div>
    
                                <div class="my-3">
                                    <label>2nd Option <span class="text-danger">*Required!</span></label>
                                    <div class="row">
                                        <div class="col-10">
                                            <input type="text" name="option2" class="form-control" value="{{ old('option2') }}">
                                            @if ($errors->has('option2'))
                                                <p class="text-danger">{{ $errors->first('option2') }}</p>
                                            @endif
                                        </div>
                                        <div class="col-2 text-center pt-1">
                                            <input type="radio" name="answer" value="option2">
                                        </div>
                                    </div>
                                </div>

                                <div class="my-3">
                                    <label>3rd Option <span class="text-primary">*optional</span></label>
                                    <div class="row">
                                        <div class="col-10">
                                            <input type="text" name="option3" class="form-control" value="{{ old('option3') }}">
                                            @if ($errors->has('option3'))
                                                <p class="text-danger">{{ $errors->first('option3') }}</p>
                                            @endif
                                        </div>
                                        <div class="col-2 text-center pt-1">
                                            <input type="radio" name="answer" value="option3">
                                        </div>
                                    </div>
                                </div>

                                <div class="my-3">
                                    <label>4th Option <span class="text-primary">*optional</span></label>
                                    <div class="row">
                                        <div class="col-10">
                                            <input type="text" name="option4" class="form-control" value="{{ old('option4') }}">
                                            @if ($errors->has('option4'))
                                                <p class="text-danger">{{ $errors->first('option4') }}</p>
                                            @endif
                                        </div>
                                        <div class="col-2 text-center pt-1">
                                            <input type="radio" name="answer" value="option4">
                                        </div>
                                    </div>
                                </div>

                                <div class="my-3">
                                    <label>5th Option <span class="text-primary">*optional</span></label>
                                    <div class="row">
                                        <div class="col-10">
                                            <input type="text" name="option5" class="form-control" value="{{ old('option5') }}">
                                            @if ($errors->has('option5'))
                                                <p class="text-danger">{{ $errors->first('option5') }}</p>
                                            @endif
                                        </div>
                                        <div class="col-2 text-center pt-1">
                                            <input type="radio" name="answer" value="option5">
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <button type="submit" class="btn btn-primary float-right mx-2">Save & Add other Question</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
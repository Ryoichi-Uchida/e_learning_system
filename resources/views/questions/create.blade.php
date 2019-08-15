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

                        {{-- Question Part --}}
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
                        
                        {{-- Options & Answer Part --}}
                        <div class="col-6 m-auto">           
                            <h3>Please input Options and an Answer</h3>
                            @if ($errors->has('answer'))
                                <p class="text-danger text-right">{{ $errors->first('answer') }}</p>
                            @endif
                            <div class="questions border px-4 mb-4">
                                {{--Now, We're putting Options 1 to 5 --}}
                                @for ($i = 1; $i <= 5; $i++)
                                    <div class="my-3">
                                        {{-- Label space. --}}
                                        @if ($i == 1)
                                            <div class="row">
                                                <div class="col-10">
                                                    <label>Option{{ $i }} <span class="text-danger">*Required!</span></label>
                                                </div>
                                                <div class="col-2 pt-1 pl-1">
                                                    <h5 class="text-danger">Answer</h5>
                                                </div>
                                            </div>  
                                        @elseif($i == 2)
                                            <label>Option{{ $i }}<span class="text-danger">*Required!</span></label>
                                        @else
                                            <label>Option{{ $i }}<span class="text-primary">*optional</span></label>
                                        @endif                           
                                        {{-- Input space. --}}
                                        <div class="row">
                                            <div class="col-10">
                                                <input type="text" name="option[{{ $i }}]" class="form-control" value="{{ old('option.'.$i) }}">
                                                @if ($errors->has(['option.'.$i]))
                                                    <p class="text-danger">{{ $errors->first('option.'.$i) }}</p>
                                                @endif
                                            </div>
                                            <div class="col-2 text-center pt-1">
                                                <input type="radio" name="answer" value="{{ $i }}">
                                            </div>
                                        </div>
                                    </div>
                                @endfor                                
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
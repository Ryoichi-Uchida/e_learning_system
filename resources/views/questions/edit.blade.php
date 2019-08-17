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
                <div class="mb-4">
                    <a href="{{ route('category.index') }}" class="btn btn-secondary float-right mr-4">Back to Question list</a>
                    <h1 class="p-2 mb-4 mx-4 border-bottom">Edit Question</h1>
                    <span class="p-2 mx-4 text-primary h5">Edit the part you want to change.</span><br>
                    <span class="p-2 mx-4 text-primary h5">You can delete an option by emptying an existing field. You can also add options by filling in new fields.</span>
                </div>
                <form action="{{ route('question.update', ['question' => $question->id ]) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row form-list">

                        {{-- Question Part --}}
                        <div class="col-4 mx-auto">
                            <div class="form-group">
                                <h3 class="mb-0">Please input a Question</h3>
                                <span class="text-danger">*Required!</span>
                                <textarea name="question" cols="10" rows="5" class="form-control">{{ old('question') != null ? old('question') : $question->content }}</textarea>
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
                                                    <label>Option{{ $i }}<span class="text-danger"> *Required!</span></label>
                                                </div>
                                                <div class="col-2 pt-1 pl-1">
                                                    <h5 class="text-danger">Answer</h5>
                                                </div>
                                            </div>  
                                        @elseif($i == 2)
                                            <label>Option{{ $i }}<span class="text-danger"> *Required!</span></label>
                                        @else
                                            <label>Option{{ $i }}<span class="text-primary"> *optional</span></label>
                                        @endif

                                        {{-- Input space. --}}
                                        <div class="row">

                                            {{-- Texting area --}}
                                            <div class="col-10">
                                                {{-- This !empty is filter to avoid error appears when if don't have options on DB--}} 
                                                @if (!empty($question->options[$i-1]))
                                                    {{-- Option 1 & 2 are required. We can't change it to empty --}}
                                                    @if ($i <= 2) 
                                                        <input type="text" name="option[{{ $i }}]" class="form-control" value="@if(old('option.'.$i)){{ old('option.'.$i) }}@else{{ $question->options[$i-1]->content }}@endif">
                                                    {{-- We can change option 3 to 5 to empty --}}
                                                    @else
                                                        <input type="text" name="option[{{ $i }}]" class="form-control" value="@if(old('option.'.$i)){{ old('option.'.$i) }}@elseif(old('option.'.$i,$question->options[$i-1]->content) == ""){{ "" }}@else{{ $question->options[$i-1]->content }}@endif">
                                                    @endif
                                                {{-- The case the question doesn't have some options --}}
                                                @else
                                                    <input type="text" name="option[{{ $i }}]" class="form-control" value="">
                                                @endif
                                                @if ($errors->has(['option.'.$i]))
                                                    <p class="text-danger">{{ $errors->first('option.'.$i) }}</p>
                                                @endif
                                            </div>

                                            {{-- Radio button --}}
                                            <div class="col-2 text-center pt-1">
                                                {{-- This !empty is filter to avoid error appears when if don't have options on DB--}} 
                                                @if (!empty($question->options[$i-1]))
                                                    {{-- The case user returns this page because of validation error --}}
                                                    @if (old('answer') !=null )
                                                        @if (old('answer') == $i)
                                                            <input type="radio" name="answer" value="{{ $i }}" checked>
                                                        @else
                                                            <input type="radio" name="answer" value="{{ $i }}">
                                                        @endif
                                                    {{-- The case user enters this page to edit --}}
                                                    @else
                                                        @if ($question->options[$i-1]->is_correct == 1)
                                                            <input type="radio" name="answer" value="{{ $i }}" checked>
                                                        @else
                                                            <input type="radio" name="answer" value="{{ $i }}">
                                                        @endif
                                                    @endif
                                                {{-- The case the question doesn't have some options --}}
                                                @else
                                                    @if (old('answer') == $i)
                                                        <input type="radio" name="answer" value="{{ $i }}" checked>
                                                    @else
                                                        <input type="radio" name="answer" value="{{ $i }}">
                                                    @endif
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                @endfor                                
                            </div>
                            <button type="submit" class="btn btn-primary float-right mx-2">Save & Back to Question list</button>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
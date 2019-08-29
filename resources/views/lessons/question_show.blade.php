@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/lessons/create.css') }}">    
@endsection

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center ">
        <div class="col-10 bg-white ">
            <div class="my-4">
                <div>
                    <span class="float-right h4 mr-4">No : <span class="h2 text-primary">{{ $finished == null ? 1 : $finished+1 }}</span> of {{ $category->questions->count() }}</span>
                    <h2 class="p-2 mb-4 mx-4 border-bottom">Lesson Title : <span class="h1 text-primary">{{ $category->title }}</span></h2>
                </div>
                <div class="col-8 m-auto">
                    <div>
                        <h4 class="mb-3">Question : </h4>
                        <h2 class="text-center text-primary">{{ $question->content }}</h3>
                    </div>
                    <div>
                        <h4 class="mb-3">Options :</h4>
                        <div class="text-center">
                            @foreach ($question->options as $option)
                                <form action="{{ route('lesson.store', ['category' => $category->id, 'question' => $question->id]) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary my-1" name="answer" value="{{ $option->id }}">
                                        {{ $option->content }}
                                    </button>
                                </form>   
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
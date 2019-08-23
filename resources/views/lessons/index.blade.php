@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/lessons/index.css') }}">    
@endsection

@section('content')
<div class="container bg-white px-5 py-3">
    <div class="border-bottom mb-4">
        <a href="" class="btn btn-outline-primary float-right mx-2">Not learned</a>
        <a href="" class="btn btn-outline-primary float-right mx-2">Learned</a>
        <a href="" class="btn btn-primary float-right mx-2">All</a>
        <h1>Lesson list</h1>      
    </div>
    <div class="row">
        @foreach ($categories as $category)
            @if (!empty($category->questions->first()))
                <div class="col-6">
                    <div class="border p-3 mb-4 lesson-list">
                        <h2>{{ $category->title }}</h2>
                        <p>{{ $category->description }}</p>
                        <div class="text-right">
                            {{-- The case user is starting this category  --}}
                            @if(Auth::user()->is_lesson_starting($category->id))
                                {{-- The case this category was finished  --}}
                                @if(Auth::user()->finished_question_no($category->id) == $category->questions->count())
                                    <a href="{{ route('lesson.result', ['category' => $category->id]) }}" class="btn btn-outline-secondary">Your Result</a>
                                {{-- The case this category is on the way  --}}
                                @else
                                    <a href="{{ route('lesson.question_show', ['category' => $category->id]) }}" class="btn btn-success">Resume</a>
                                @endif
                            {{-- The case user isn't starting this category yet  --}}
                            @else
                                <a href="{{ route('lesson.question_show', ['category' => $category->id]) }}" class="btn btn-primary">Start</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $categories->links() }}
    </div>
</div>  
@endsection
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/lessons/result.css') }}">    
@endsection

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-10 bg-white">
            <div class="my-4">
                <div class="my-4">
                    @if ($user->id == Auth::user()->id)
                        <a href="{{ route('lesson.index') }}" class="btn btn-secondary float-right mr-4">Go to Lesson List</a>    
                        <a href="{{ route('home.show') }}" class="btn btn-success float-right mr-4">Go to Profile</a>
                    @else
                        <a href="{{ url()->previous() }}" class="btn btn-secondary float-right mr-4">Back</a>    
                        <a href="{{ route('user.show', ['user' => $user->id]) }}" class="btn btn-success float-right mr-2">Go to User Profile</a>
                    @endif
                    <img src="/images/{{ $user->avatar }}" alt="" class="avatar mr-2 mb-4">
                    <span class="text-primary h1 pt-4">{{ $user->name }}</span><span class="h4 pt-5"> 's Lesson</span>
                </div>
                <div>
                    <span class="float-right h4">Result : <span class="h2 text-primary">{{ $correct_no }}</span> of {{ $category->questions->count() }}</span>
                    <h3 class="p-2 mb-4 mx-4 border-bottom">Lesson Title : <span class="h1 text-primary">{{ $category->title }}</span></h3>
                </div>
                <div class="col-10 m-auto">
                    <table class="table table-striped table-borderless">
                        <thead>
                            <tr class="h3 text-center">
                                <th style="width:50%;">Question</th>
                                <th style="width:20%;">Your Answer</th>
                                <th style="width:20%;">Correct Answer</th>
                                <th style="width:10%;">Judgment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->lessons->where('category_id', $category->id)->first()->answers as $answer)
                                <tr class="align-middle">
                                    <td>{{ $answer->question->content }}</td>
                                    {{-- The case of uncorrect --}}
                                    @if($answer->option->content != $category->questions->where('id', $answer->question_id)->first()->options->where('is_correct', 1)->first()->content)
                                        <td class="text-center">{{ $answer->option->content }}</td> 
                                        <td class="text-center text-primary">{{ $category->questions->where('id', $answer->question_id)->first()->options->where('is_correct', 1)->first()->content }}</td>
                                        <td class="text-center text-danger">×</td>
                                    {{-- The case of correct --}}
                                    @else
                                        <td class="text-center text-primary">{{ $answer->option->content }}</td>
                                        <td></td>
                                        <td class="text-center text-primary">◯</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

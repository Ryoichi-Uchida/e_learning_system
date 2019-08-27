@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">    
@endsection

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-10 bg-white">
            <div class="my-4">
                <div class="my-4 border-bottom">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary float-right mr-4">Back</a>    
                    <img src="/images/{{ $user->avatar }}" alt="" class="avatar mr-2 mb-4">
                    <span class="text-primary h1 pt-4">All words {{ $user->name }} learned</span>
                </div>
                <div class="col-12 m-auto">
                    {{-- The case you don't have learned word --}}
                    @if (empty($lessons->first()) && $user->id == Auth::user()->id)
                        <div class="text-danger text-center mx-auto">
                            <h1>You don't have learned word yet</h1>
                        </div>
                    {{-- The case other user doesn't have learned word --}}
                    @elseif(empty($lessons->first()) && $user->id != Auth::user()->id)
                        <div class="text-danger text-center mx-auto">
                            <h1>The member doesn't have learned word yet</h1>
                        </div>
                    {{-- The case the user has learned word --}}
                    @else
                        <h4 class="text-center text-primary pb-3">You can check {{ $user->name }}'s learned history every 10 lessons.</h4>
                        <span class="float-right h4">Total Result : <span class="h2 text-primary">{{ $user->finished_all_no()['correct'] }}</span> of {{ $user->finished_all_no()['all'] }}</span>
                        <table class="table table-striped table-borderless">
                            <thead>
                                <tr class="h3 text-center">
                                    <th style="width:40%;">Question</th>
                                    <th style="width:20%;">{{ $user->name }}'s Answer</th>
                                    <th style="width:20%;">Correct Answer</th>
                                    <th style="width:20%;">Category</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lessons as $lesson)
                                    @foreach ($lesson->answers as $answer)
                                        <tr class="align-middle">
                                            <td>{{ $answer->question->content }}</td>
                                                {{-- The case of uncorrect --}}
                                                @if ($answer->option->content != $lesson->category->questions->where('id', $answer->question_id)->first()->correct_option())
                                                    <td class="text-center">{{ $answer->option->content }}</td>
                                                    <td class="text-center text-primary">{{ $lesson->category->questions->where('id', $answer->question_id)->first()->correct_option() }}</td>
                                                {{-- The case of correct --}}
                                                @else
                                                    <td class="text-center text-primary">{{ $answer->option->content }}</td>
                                                    <td class="text-center">-</td> 
                                                @endif
                                            <td class="text-center">{{ $lesson->category->title }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $lessons->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

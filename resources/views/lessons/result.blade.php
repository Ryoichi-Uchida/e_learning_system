@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-10 bg-white">
            <div class="my-4">
                <div>
                    <a href="{{ route('lesson.index') }}" class="btn btn-secondary float-right mr-4">Back to Lesson List</a>
                    <h1 class="p-2 mb-4 mx-4 border-bottom">Lesson Title</h1>
                </div>
                <div class="col-10 m-auto">
                    <span class="float-right h4">Result : <span class="h2 text-primary">{{ $correct_no }}</span> of {{ $category->questions->count() }}</span>
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
                            @foreach (Auth::user()->lessons->where('category_id', $category->id)->first()->answers as $answer)
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

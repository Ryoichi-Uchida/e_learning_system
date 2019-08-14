@extends('layouts.app')

@section('content')
<div class="container border-bottom">
        <a href="{{ route('category.index') }}" class="btn btn-secondary float-right">Back to list</a>
    <h1>Lesson Editor</h1>    
</div>

<div class="container mt-3">
    <div class="border-bottom my-4 pb-3">
        <form action="{{ route('category.destroy',['category' => $category->id]) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger float-right ml-2">
                <span>Delete</span>
            </button>
        </form>
        <a href="" class="btn btn-success float-right">Edit</a> 
        <h2>Title : {{ $category->title }}</h2>
        <h2>Description : {{ $category->description }}</h2>
    </div>
    <div class="bg-white">

        <div class="row mt-2 pt-4">
            <div class="col-10 mx-auto">
                <a href="{{ route('question.create', ['category' => $category->id]) }}" class="btn btn-primary float-right">Add new question</a>
                <h1>Contents</h1>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-10">
                <table class="table table-striped">
                    <thead class="h3 text-center">
                        <tr>
                            <th style="width:40%;">Question</th>
                            <th style="width:20%;">Options</th>
                            <th style="width:20%;">Answer</th>
                            <th style="width:20%;">Functions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($questions as $question)
                            <tr>
                                <td class="align-middle"><a href="">{{ $question->content }}</a></td>
                                <td>
                                    @foreach ($question->options()->get() as $option)
                                        <p>{{ $option->content }}</p>                                        
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    @foreach ($question->options()->get() as $option)
                                        @if($option->is_correct)
                                            <p>◯</p>
                                        @else
                                            <p>-</p>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="align-middle text-center">
                                    <a href="" class="btn btn-outline-success mx-1">Edit</a>
                                    <form action="{{ route('question.destroy', ['question' => $question->id]) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">
                                            <span>Delete</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

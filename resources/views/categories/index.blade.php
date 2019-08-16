@extends('layouts.app')

@section('content')
<div class="container border-bottom">
    <a href="{{ route('category.create') }}" class="btn btn-primary float-right">Add New Category</a>    
    <h1>Category List</h1>    
</div>
<div class="container mt-3">
    <table class="table table-striped table-borderless">
        <thead>
            <tr class="h3 text-center">
                <th style="width:20%;">Title</th>
                <th style="width:40%;">Description</th>
                <th style="width:10%;">Questions</th>
                <th style="width:30%;">Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td class="align-middle"><a href="{{ route('category.show', ['category' => $category->id]) }}">{{ $category->title }}</a></td>
                    <td class="align-middle">{{ $category->description }}</td>
                    <td class="align-middle text-center">{{ $category->questions()->count() }}</td>
                    <td class="d-flex justify-content-center border-0">
                        <a href="{{ route('question.create', ['category' => $category->id]) }}" class="btn btn-outline-primary mx-1">Add question</a>
                        <a href="{{ route('category.edit', ['category' => $category->id]) }}" class="btn btn-outline-success mx-1">edit</a>
                        <form action="{{ route('category.destroy', ['category' => $category->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger mx-1">
                                <span>Delete</span>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $categories->links() }}
    </div>
</div>
@endsection

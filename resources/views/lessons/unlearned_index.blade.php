@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/lessons/index.css') }}">    
@endsection

@section('content')
<div class="container bg-white px-5 py-3">
    <div class="border-bottom mb-4">
        @include('../partials/lesson_button')
    </div>
    <div class="row">
        @foreach ($categories as $category)
            @if (!empty($category->questions->first()))
                @include('../partials/lesson_list')
            @endif
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $categories->links() }}
    </div>
</div>  
@endsection
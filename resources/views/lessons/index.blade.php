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
        <div class="col-6">
            <div class="border p-3 mb-4 lesson-list">
                <h2>Lesson Title</h2>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur quia magni dignissimos in inventore ipsa reiciendis alias, vel fuga</p>
                <div class="text-right">
                    <a href="" class="btn btn-primary">Start</a>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="border p-3 mb-4 lesson-list">
                <span class="score float-right bg-primary text-white px-2">Score : 3 of 5</span>
                <h2>Lesson Title</h2>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur quia magni dignissimos in inventore ipsa reiciendis alias, vel fuga</p>
                <div class="text-right">
                    <a href="" class="btn btn-outline-secondary">Your Result</a>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="border p-3 mb-4 lesson-list">
                <h2>Lesson Title</h2>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur quia magni dignissimos in inventore ipsa reiciendis alias, vel fuga</p>
                <div class="text-right">
                    <a href="" class="btn btn-primary">Start</a>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="border p-3 mb-4 lesson-list">
                <h2>Lesson Title</h2>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur quia magni dignissimos in inventore ipsa reiciendis alias, vel fuga</p>
                <div class="text-right">
                    <a href="" class="btn btn-primary">Start</a>
                </div>
            </div>
        </div>
    </div>
</div>  
@endsection
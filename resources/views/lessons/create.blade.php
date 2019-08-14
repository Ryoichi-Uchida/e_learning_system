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
                    <span class="float-right h4 mr-4">No : <span class="h2 text-primary">2</span> of 5</span>
                    <h1 class="p-2 mb-4 mx-4 border-bottom">Lesson Title</h1>
                </div>
                <div class="col-8 m-auto">
                    <form action="" method="post">
                        <div>
                            <h4 class="mb-3">Question : </h4>
                            <h2 class="text-center text-primary">What you have to follow.</h3>
                        </div>
                        <div>
                            <h4 class="mb-3">Options :</h4>
                            <div class="text-center">
                                <button type="submit" class="btn btn-outline-primary my-1" value="">Law</button>
                                <button type="submit" class="btn btn-outline-primary my-1" value="">Low</button>
                                <button type="submit" class="btn btn-outline-primary my-1" value="">Lou</button>
                                <button type="submit" class="btn btn-outline-primary my-1" value="">Row</button>
                                <button type="submit" class="btn btn-outline-primary my-1" value="">Raw</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
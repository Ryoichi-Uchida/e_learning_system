@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center ">
        <div class="col-10 bg-white ">
            <div class="my-4">
                <div class="title">
                    <a href="{{ route('category.index') }}" class="btn btn-secondary float-right mr-4">Back to list</a>
                    <h1 class="p-2 mb-4 mx-4 border-bottom">Add New Category</h1>
                </div>
                <div class="col-8 m-auto">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary float-right">Go to making Question</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
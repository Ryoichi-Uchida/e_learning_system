@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center ">
        <div class="col-10 bg-white ">
            <div class="my-4">
                <div class="title">
                    <a href="{{ route('category.show', ['category' => $category->id ]) }}" class="btn btn-secondary float-right mr-4">Back to this Category</a>
                    <h1 class="p-2 mb-4 mx-4 border-bottom">Edit Category</h1>
                </div>
                <div class="col-8 m-auto">
                    <form action="{{ route('category.update', ['category' => $category->id]) }}" method="post">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="title" class="d-block my-0 py-0">Title<span class="text-primary pl-2">( Current : {{ $category->title }} )</span></label>
                            <label for="title" class="ml-2"><span class="text-danger pl-2">*If you don't want to change title, please leave this field empty.</span></label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') != null ? old('title') : "" }}">
                            @if ($errors->has('title'))
                                <p class="text-danger">{{ $errors->first('title') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="description"class="d-block my-0 py-0">Description</label>
                            <label for="description" class="ml-2"><span class="text-danger pl-2">*If you don't want to change Description, please leave this field empty.</span></label>
                            <textarea name="description" cols="30" rows="10" class="form-control">{{ old('description') != null ? old('description') : "" }}</textarea>
                            @if ($errors->has('description'))
                                <p class="text-danger">{{ $errors->first('description') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="su d-blockbmit" class="btn btn-primary float-right">Save & Back to this Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
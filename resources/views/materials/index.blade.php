@extends('layouts.app')

@section('content')
<div class="container border-bottom">
    <a href="" class="btn btn-primary float-right">Add New Category</a>    
    <h1>Category List</h1>    
</div>
<div class="container mt-3">
    <table class="table table-striped table-borderless">
        <thead>
            <tr class="h3">
                <th style="width:20%;">Title</th>
                <th style="width:50%;">Description</th>
                <th style="width:30%;">Options</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="align-middle"><a href="">Food</a></td>
                <td class="align-middle">This is a lesson about Food</td>
                <td class="d-flex justify-content-center border-0">
                    <a href="" class="btn btn-outline-primary mx-1">Add question</a>
                    <a href="" class="btn btn-outline-success mx-1">edit</a>
                    <a href="" class="btn btn-outline-danger mx-1">delete</a>
                </td>
            </tr>
            <tr>
                <td class="align-middle"><a href="">Animal</a></td>
                <td class="align-middle">This is a lesson about Animal</td>
                <td class="d-flex justify-content-center">
                    <a href="" class="btn btn-outline-primary mx-1">Add question</a>
                    <a href="" class="btn btn-outline-success mx-1">Edit</a>
                    <a href="" class="btn btn-outline-danger mx-1">Delete</a>
                </td>
            </tr>
            <tr>
                <td class="align-middle"><a href="">Technology</a></td>
                <td class="align-middle">This is a lesson about Technology</td>
                <td class="d-flex justify-content-center">
                    <a href="" class="btn btn-outline-primary mx-1">Add question</a>
                    <a href="" class="btn btn-outline-success mx-1">Edit</a>
                    <a href="" class="btn btn-outline-danger mx-1">Delete</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

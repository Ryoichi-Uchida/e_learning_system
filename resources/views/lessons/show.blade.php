@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-10 bg-white">
            <div class="my-4">
                <div>
                    <a href="" class="btn btn-secondary float-right mr-4">Back to List</a>
                    <h1 class="p-2 mb-4 mx-4 border-bottom">Lesson Title</h1>
                </div>
                <div class="col-10 m-auto">
                    <span class="float-right h4">Result : <span class="h2 text-primary">2</span> of 5</span>
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
                            <tr class="align-middle">
                                <td>What you have to follow.</td>
                                <td class="text-center">Law</td>
                                <td class="text-center">Law</td>
                                <td class="text-center text-primary">◯</td>
                            </tr>
                            <tr class="align-middle">
                                <td>Second Question</td>
                                <td class="text-center">A</td>
                                <td class="text-center">B</td>
                                <td class="text-center text-danger">×</td>
                            </tr>
                            <tr class="align-middle">
                                <td>Third Question</td>
                                <td class="text-center">B</td>
                                <td class="text-center">B</td>
                                <td class="text-center text-primary">◯</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

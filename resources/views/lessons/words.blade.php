@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-10 bg-white">
            <div class="my-4">
                <div>
                    <a href="{{ route('home.show') }}" class="btn btn-secondary float-right mr-4">Back to your profile</a>
                    <h1 class="p-2 mb-4 mx-4 border-bottom">All words ** learned</h1>
                </div>
                <div class="col-12 m-auto">
                    <span class="float-right h4">Total Result : <span class="h2 text-primary">1</span> of 3</span>
                    <table class="table table-striped table-borderless">
                        <thead>
                            <tr class="h3 text-center">
                                <th style="width:40%;">Question</th>
                                <th style="width:20%;">Your Answer</th>
                                <th style="width:20%;">Correct Answer</th>
                                <th style="width:20%;">Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="align-middle">
                                <td>What you have to follow.</td>
                                <td class="text-center text-primary">Law</td>
                                <td class="text-center"></td>
                                <td class="text-center">Society</td>
                            </tr>
                            <tr class="align-middle">
                                <td>What is the coldest country.</td>
                                <td class="text-center">Philippines</td>
                                <td class="text-center text-primary">Canada</td>
                                <td class="text-center">Country</td>
                            </tr>
                            <tr class="align-middle">
                                <td>What is red fruite.</td>
                                <td class="text-center">Banana</td>
                                <td class="text-center text-primary">Strawberry</td>
                                <td class="text-center">Fruite</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

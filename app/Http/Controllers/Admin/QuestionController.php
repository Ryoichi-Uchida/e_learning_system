<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Question;
use App\Option;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        return view('questions.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {
        
        // dd($request->all());

        $request->validate([
            'question' => ['required', 'max:255'],
            'option1' => ['required', 'max:255'],
            'option2' => ['required', 'max:255'],
            'option3' => ['max:255'],
            'option4' => ['max:255'],
            'option5' => ['max:255'],
            'answer' => ['required']
        ]);

        // foreach ($request->options as $option) {
        //     if($option == null && $request->answer == $option){
        //         $request->validate([

        //         ]);
        //     }
        // }


        //Making a new question
        $question = new Question();
        $question->content = $request->question;
        $category->questions()->save($question);


        //Making option1
        $option = new Option();
        $option->content = $request->option1;
        if($request->answer == 'option1')
            $option->is_correct = '1';
        $question->options()->save($option);

        //Making option2
        $option = new Option();
        $option->content = $request->option2;
        if($request->answer == 'option2')
            $option->is_correct = '1';
        $question->options()->save($option);

        //If you make more option...
        // $option = new Option();
        // $option->content = $request->option2;
        // if($request->answer == $request->option2)
        //     $option->is_correct = '1';
        // $category->options()->save($option);

        return view('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

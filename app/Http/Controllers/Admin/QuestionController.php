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
        $request->validate([
            'question' => ['required', 'max:255'],
            'option.1' => ['required'],
            'option.2' => ['required'],
            'option.3' => ['nullable', 'required_if:answer,3'],
            'option.4' => ['nullable', 'required_if:answer,4'],
            'option.5' => ['nullable', 'required_if:answer,5'],
            'option.*' => ['distinct', 'max:255'],
            'answer' => ['required']
        ]);

        //Making a new question
        $question = $category->questions()->create(['content' => $request->question]);

        //Making options
        foreach($request->option as $key => $option){
            if($option != null){
                if($request->answer == $key){
                    $question->options()->create(['content' => $option, 'is_correct' => '1']);
                }else{
                    $question->options()->create(['content' => $option]);
                }
            }
        }

        return redirect()->route('question.create', ['category' => $category])->with('status', 'New Question added!');
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
    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->back();
    }
}

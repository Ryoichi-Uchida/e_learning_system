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
    public function edit(Question $question)
    {
        return view('questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
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

        //Updating a question
        $question->update([
            'content' => $request->question
        ]);

        //Updating options
        //Foreach rotate 5 times, because Request always has 5 options incruding null(These keys are 1 to 5).
        foreach($request->option as $key => $new_option){
            //The case DB has each option(option's key starts from 0)
            if(!empty($question->options[$key-1])){
                $current_option = $question->options[$key-1];               
                //If user change form to empty, it's delete. 
                if($new_option == null){
                    $current_option->delete();              
                //If user overwrite a option, it's update.
                }else{
                    if($request->answer == $key){
                        $current_option->update(['content' => $new_option, 'is_correct' => '1']);
                    }else
                        $current_option->update(['content' => $new_option, 'is_correct' => '0']);                        
                }
            //The case DB doesn't have a option and request has new option, it's create.
            }else{
                if($new_option != null){
                    if($request->answer == $key){
                        $question->options()->create(['content' => $new_option, 'is_correct' => '1']);
                    }else{
                        $question->options()->create(['content' => $new_option, 'is_correct' => '0']);
                    }
                }
            } 
        }

        return redirect()->route('category.show', ['category' => $question->category]);
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

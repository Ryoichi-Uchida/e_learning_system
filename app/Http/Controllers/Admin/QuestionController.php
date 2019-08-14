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
            'option1' => ['required', 'max:255'],
            'option2' => ['required', 'max:255'],
            'option3' => ['max:255'],
            'option4' => ['max:255'],
            'option5' => ['max:255'],
            'answer' => ['required']
        ]);

        //Making a new question
        $question = $category->questions()->create(['content' => $request->question]);

        //Making option1 and 2(required)
        if($request->answer == 'option1'){
            $question->options()->create(['content' => $request->option1, 'is_correct' => '1']);
        }else{
            $question->options()->create(['content' => $request->option1]);
        }

        if($request->answer == 'option2'){
            $question->options()->create(['content' => $request->option2, 'is_correct' => '1']);
        }else{
            $question->options()->create(['content' => $request->option2]);
        }

        // //Making option3 to 5(optional)
        if($request->option3 != null){
            if($request->answer == 'option3'){
                $question->options()->create(['content' => $request->option3, 'is_correct' => '1']);
            }else{
                $question->options()->create(['content' => $request->option3]);
            }
        }

        if($request->option4 != null){
            if($request->answer == 'option4'){
                $question->options()->create(['content' => $request->option4, 'is_correct' => '1']);
            }else{
                $question->options()->create(['content' => $request->option4]);
            }
        }

        if($request->option5 != null){
            if($request->answer == 'option5'){
                $question->options()->create(['content' => $request->option5, 'is_correct' => '1']);
            }else{
                $question->options()->create(['content' => $request->option5]);
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
    public function destroy($id)
    {
        //
    }
}

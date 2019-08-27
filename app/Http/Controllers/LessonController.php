<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use App\Category;
use App\Question;
use App\Lesson;
use App\Answer;
use App\user;


class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);

        return view('lessons.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Category $category, Question $question, Request $request)
    {
        // If DB has the user's category, it gets category.
        if(Lesson::where('user_id', Auth::user()->id)->where('category_id', $category->id)->first()){

            $lesson = Lesson::where('user_id', Auth::user()->id)
                                ->where('category_id', $category->id)
                                ->first();
        // If DB doesn't have the user's category, it makes new category.                      
        }else{
            $lesson =
                Lesson::create([
                    'user_id' => Auth::user()->id,
                    'category_id' => $category->id
                ]);
        }

        //Create new answer
        Answer::create([
            'user_category_id' => $lesson->id,
            'question_id' => $question->id,
            'option_id' => $request->answer
        ]);

        return redirect()->route('lesson.question_show', ['category' => $category->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
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

    /**
     * Show the questions to users.
     *
     * @return \Illuminate\Http\Response
     */
    public function question_show(Category $category)
    {
        //It searches suspend point of a lesson.
        if(Auth::user()->is_lesson_starting($category->id)){
            $finished = Auth::user()->finished_question_no($category->id);
        }else{
            $finished = "";
        }

        //It searches remaining question from $finished_question_no
        if(!empty($category->questions[$finished])){
            $next = $category->questions[$finished];
        }else{
            $next = "";
        }

        //If finished question is empty, it shows first question
        if(empty($finished)){
            $question = $category->questions[0];
            
            return view('lessons.question_show', compact('category', 'question', 'finished'));
        
        //If finished question & next question isn't empty, it shows next question
        }elseif(!empty($finished) && !empty($next)){
            $question = $next;

            return view('lessons.question_show', compact('category', 'question', 'finished'));
        
        //It shows result
        }else{
            //It makes a new activity
            Auth::user()->make_lesson_activity($category->id);

            return redirect()->route('lesson.result',compact('category'));
        }        
    }

    /**
     * Show the lesson result to users.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function result(User $user, Category $category)
    {
        $correct_no = $user
                        ->lessons->where('category_id', $category->id)->first()
                        ->correct_no();
        
        return view('lessons.result', compact('user', 'category', 'correct_no'));
    }

     /** Display a listing of one user's learned words.
     *
     * @return \Illuminate\Http\Response
     */
    public function words()
    {
        return view('lessons.words');
    }
}

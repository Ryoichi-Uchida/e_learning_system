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
        // dd($request->all());
        // dd($question->options->all());

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

        $question->update([
            'content' => $request->question
        ]);

        // foreach(array_map(null, $question->options, $request->option) as [$current_option, $new_option]){
        //     array_key_first($new_option);
        //     dd(array_key_first($new_option));
        // }

    
        // while ( (list($question->options, $current_option) = each($array1))  
        //     && (list($key2, $val2) = each($array2)) ) {

        //         echo $val1.$val2;

        // foreach($question->options as $key => $current_option){
        //     $new_option = $request->option[$key+1]; 
            
        //     //If there is current option & user change it to empty, we should delete a option from DB. 
        //     if(!empty($current_option) && $new_option == null){
        //         $current_option->delete();
        //     //We can update current option or make new option.
        //     }else{
        //         //If the option is correct, we change status of is_correct.
        //         if($request->answer == $key+1){
        //             $current_option->updateOrCreate(
        //                 ['id' => $current_option->id],
        //                 ['content' => $new_option, 'is_correct' => '1']
        //             );
        //         }else
        //             $current_option->updateOrCreate(
        //                 ['id' => $current_option->id],
        //                 ['content' => $new_option]
        //             );
        //     }
        
        // }

        foreach($question->options as $key => $current_option){
            $new_option = $request->option[$key+1]; 
            //If there is current option & user change it to empty, it's delete. We should delete a option from DB. 
            if(!empty($current_option) && $new_option == null){
                $current_option->delete();
            //If user overwrite a option, it's update.
            }elseif(!empty($current_option) && $new_option != null){
                if($request->answer == $key+1){
                    $current_option->update([
                        'content' => $new_option,
                        'is_correct' => '1'
                    ]);
                }else
                    $current_option->update([
                        'content' => $new_option,
                        'is_correct' => '0'
                    ]);
            //If user add a new data to empty space, it's create.
            }else{
                if($request->answer == $key+1){
                    // $question->options()->create(['content' => $new_option, 'is_correct' => '1']);
                    $option = new Option();
                    $option->content = $new_option;
                    $option->is_correct = '1';
                    $question->options()->save($option);
                }else{
                    // $question->options()->create(['content' => $new_option]);
                    $option = new Option();
                    $option->content = $new_option;
                    $question->options()->save($option);
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

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(15);

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'unique:categories', 'max:255'],
            'description' => ['required', 'min:10', 'max:255']
        ]);

        $category = Category::create($request->all());
        
        return redirect()->route('question.create', ['category' => $category->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $questions = $category->questions;

        return view('categories.show', compact('category', 'questions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' => ['nullable', 'unique:categories', 'max:255'],
            'description' => ['nullable', 'min:10', 'max:255']
        ],[
            'title.unique' => "The title has already been used. If you don't want to change, please change this field to empty."
        ]);

        if(!empty($request->title)){
            $category->update([
                'title' => $request->title
            ]);
        }

        if(!empty($request->description)){
            $category->update([
                'description' => $request->description
            ]);
        }

        // $category = Category::create($request->all());
        
        return redirect()->route('category.show', ['category' => $category]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index');
    }
}

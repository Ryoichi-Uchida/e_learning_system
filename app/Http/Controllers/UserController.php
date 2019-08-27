<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::whereNotIn('id', [Auth::user()->id])->paginate(10);
        
        return view('users.index', compact('users'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
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
     * Add and delete the specified relationship in storage.
     */
    public function follow(User $user)
    {
        Auth::user()->following()->attach($user);

        return redirect()->back();
    }
    
    public function unfollow(User $user)
    {
        Auth::user()->following()->detach($user);

        return redirect()->back();
    }

    /**
     * Display a listing of the following and follwed.
     */
    public function following(User $user)
    {
        $users = $user->following()->paginate(10);

        return view('users.following', compact('users', 'user'));
    }

    public function followers(User $user)
    {
        $users = $user->followers()->paginate(10);       

        return view('users.followers', compact('users', 'user'));
    }

    public function words(User $user)
    {
        //Users can check words in descending order of lessons(It means the number of words you can see same page will vary).
        $lessons = $user->lessons()->orderBy('created_at', 'desc')->paginate(10);

        return view('users.words',compact('lessons', 'user'));
    }
}

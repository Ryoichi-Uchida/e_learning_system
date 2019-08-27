<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Follow;
use App\Activity;

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
        // getting this user's activitues
        $activities = $user->activities()->paginate(5);
        
        return view('users.show', compact('user', 'activities'));
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
        // It makes a new instance of follows
        Auth::user()->following()->attach($user);
        
        $follow = Follow::where('following_id', Auth::user()->id)->where('followed_id', $user->id)->first();

        // It makes a new activity
        Activity::create([
            'user_id' => Auth::user()->id,
            'activity_type' => 'follow',
            'activity_id' => $follow->id
        ]);
        
        return redirect()->back();
    }
    
    public function unfollow(User $user)
    {
        // It Seraches this follow instance before delete.
        $follow = Follow::where('following_id', Auth::user()->id)->where('followed_id', $user->id)->first();

        // It deletes an instance of follows
        Auth::user()->following()->detach($user);

        // It deletes an activity
        Activity::where('activity_id', $follow->id)->where('activity_type', 'follow')->first()->delete();

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
}

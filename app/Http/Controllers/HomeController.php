<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Activity;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // getting all user's activitues
        $activities = Activity::orderBy('created_at', 'desc')->paginate(10);

        return view('home', compact('activities'));
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        // getting this user's activities
        $activities = Auth::user()->activities()->paginate(5);

        return view('home.show', compact('activities'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view('home.edit');
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'new_password' => ['nullable', 'string', 'min:6', 'confirmed']
        ]);

        if(!empty($request->avatar)){
            $request->validate([
                'avatar' => ['mimes:jpeg,jpg,png,gif', 'max:1024']
            ]);

            $imageName = time() . '.' . $request->avatar->getClientOriginalExtension();

            Auth::user()->update([
                'avatar' => $imageName
            ]);

            $request->avatar->move(public_path('images'), $imageName);
        }

        if(!empty($request->name)){
            Auth::user()->update([
                'name' => $request->name
            ]);
        }

        if(!empty($request->email)){
            Auth::user()->update([
                'email' => $request->email
            ]);
        }

        if(!empty($request->new_password)){
            Auth::user()->update([
                'password' => bcrypt($request->new_password)
            ]);
        }

        return redirect()->route('home');
    }
}

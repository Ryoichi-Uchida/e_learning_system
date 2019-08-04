<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('home');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('home.show');
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

    public function update_name(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        Auth::user()->update([
            'name' =>  $request->name
        ]);

        return redirect()->route('home');
    }

    public function update_email(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
        ]);

        Auth::user()->update([
            'email' => $request->email
        ]);

        return redirect()->route('home');
    }

    public function update_avatar(Request $request)
    {
        $request->validate([
            'avatar' => ['required', 'mimes:jpeg,jpg,png,gif', 'max:1024']
        ]);

        $imageName = time() . '.' . $request->avatar->getClientOriginalExtension();
        
        Auth::user()->update([
            'avatar' => $imageName
        ]);
        
        $request->avatar->move(public_path('images'), $imageName);

        return redirect()->route('home');
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'new_password' => ['required', 'string', 'min:6', 'confirmed']
        ]);

        Auth::user()->update([
            'password' => bcrypt($request->new_password)
        ]);

        return redirect()->route('home');
    }
}

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

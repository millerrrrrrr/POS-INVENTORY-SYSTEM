<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('login.index');
    }

    public function loginPost(Request $request){
        $creds = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($creds)){
            $request->session()->regenerate();

            return redirect()->route('home')->with('success', 'Logged in successfully');

        }
        return back()->with('error', 'Invalid username or password');
    }

    // public function logout(){
    //     session()->invalidate();
    //     return redirect()->route('login')->with('success', 'Logged out successfully');
    // }
}

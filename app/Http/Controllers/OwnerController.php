<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function loginForm(){
        return view('ownerLogin');
    }

    public function loginPost(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]); 

        if(
            $request->username === env('OWNER_USERNAME') &&
            $request->password === env('OWNER_PASSWORD')
        ){
            $request->session()->put('is_owner', true);
            return redirect()->route('home')->with('success', 'Login successful');
        }
        return back()->with('error', 'Invalid credentials')->withInput();
    }
}

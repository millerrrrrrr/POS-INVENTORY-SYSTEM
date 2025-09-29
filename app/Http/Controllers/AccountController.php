<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function logout(Request $request){

        $request->session()->forget('is_owner');
        return redirect()->route('owner.login')->with('success', 'Logged out successfully'); 
    }

    public function changePasswordIndex(){
        return view('account.changePassword');
    }

    public function changePasswordPost(Request $request){
        $request->validate([
            'currentPassword' => 'required',
            'password' => 'required|confirmed',   
        ]);
        if($request->currentPassword !== env('OWNER_PASSWORD')){
            return back()->with('error', 'Current password is incorrect');
        }
        $this->setEnvValue('OWNER_PASSWORD', $request->password);
        return back()->with('success', 'Password changed successfully');
    }

    private function setEnvValue($key, $value){
        $path = base_path('.env');

        if(file_exists($path)){
            file_put_contents(
                $path, 
                preg_replace(
                    "/^{$key}=.*/m",
                    "{$key}={$value}",
                    file_get_contents($path)
                )
                );
        }
    }
    
}   

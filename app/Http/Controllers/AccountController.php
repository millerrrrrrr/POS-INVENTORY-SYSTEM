<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function logout(Request $request){

        $request->session()->invalidate();
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



    public function AccountSettings(){

        $user = Auth::user();
        
        return view('account.settings', compact('user'));
    }
    
    public function changeUsername(){

        $username = Auth::user()->username;

        return view('account.changeusername', compact('username'));
    }

    public function changeCreds(Request $request){

        $request->validate([
            'username' => 'required',
            'currentPassword' => 'required',
            'password' => 'required|confirmed',
            
        ]);

        $user = Auth::user();

        if(!Hash::check($request->currentPassword, $user->password)){
            return back()->with('error', 'Current password is incorrect');
        }

        $request->user()->update([
            'username' => $request->username,
            'password' => Hash::make($request->newpassword),
        ]);

           Auth::login($user);

        return redirect()->route('AccountSettings')->with('success', 'Credentials updated successfully');


    }
}   

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class loginController extends Controller
{
    //
    public function index(){
        return view("login",[
            "title" =>"Form Login",
        ]);
    }

    
    public function authenticate(Request $request)
    {
       $credentials = $request->validate([
        'email' => 'required|email:rfc,dns',
        'password' => 'required'
    ]);
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/home');
    }
        return back()->with('loginError','Login failed !');
    }

    public function logout(Request $request){
        
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');
    }
}

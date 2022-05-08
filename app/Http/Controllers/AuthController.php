<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login',[
            'title' => 'Login User'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
           
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            if(Auth::user()->role == 'admin')
            {
                return redirect()->intended('/admin');
            }
            return redirect()->intended();

        }

        return back()->with('errorLogin',"Login Failed!");
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}

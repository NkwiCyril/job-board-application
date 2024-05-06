<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login() {
        return view('auth.login');
    }
    
    public function logout() {
        return view('auth.login');
    }

    // authenticate users
    public function authenticate(Request $request) {        
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $user = User::where('email', $request->email)->first();
            $user->logged_in = true;
            $user->save();
            
            $request->session()->regenerate();
            $new = session()->get('user');
            // $redirectPath = $user->usertype === 'seeker' ? 'seeker/home' : 'company/home';

            return redirect()->intended('/')->with([
                'user' => $new,
            ]);

            
        }
 
        return back()->withErrors([
            'email' => 'The provided email/password do not match our records!',
        ])->onlyInput('email');
    }
}
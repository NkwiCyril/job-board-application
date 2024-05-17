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

    public function logout(Request $request) {

        // change logged in status to false in the database
        $user = User::where('id', $request->user_id)->first();
        $user->logged_in = false;
        $user->save();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        
        return redirect('/')->with('success', 'You have logged out successfully!');

    }

    // authenticate users
    public function authenticate(Request $request) {     
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'rememder_me' => 'string',
        ]);

        $remember = $request['remember_me'] === 'on' ? true : false;

        if (Auth::attempt($credentials, $remember)) {
            $user = User::where('email', $request->email)->first();
            $user->logged_in = true;
            $user->save();
            
            $request->session()->regenerate();
            $new = session()->get('user');
    
            return redirect()->intended('/')->with([
                'user' => $new,
                'success' => 'Welcome! You have successfully logged in.',
            ]);
        } else {
            return back()->withErrors([
                'error' => 'The provided email/password do not match our records!',
            ]);
        }
    }
}
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

        
        return redirect('/')->with('success', 'Logged out successfully!');

    }

    // authenticate users
    public function authenticate(Request $request) {        
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials, true)) {
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
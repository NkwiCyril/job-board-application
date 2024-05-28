<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Get the login page for existing users to sign in.
     */
    public function index(): View
    {
        return view('auth.login');
    }

    /**
     * Logout the current user and return to the homepage.
     *
     * @param  object  $request
     */
    public function logout(Request $request): RedirectResponse
    {

        // change logged_in status to false in the database
        $user = User::where('id', $request->user_id)->first();
        $user->logged_in = false;
        $user->save();

        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home.index')->with('success', 'You have logged out successfully!');

    }

    /**
     * Authenticate users
     *
     * @param  object  $request
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'rememder_me' => 'string',
        ]);

        $remember = $request['remember_me'] === 'on' ? true : false;

        if (auth()->attempt($credentials, $remember)) {
            $user = User::where('email', $credentials['email'])->first();
            $user->logged_in = true;
            $user->save();

            $request->session()->regenerate();
            $new = session()->get('user');

            return redirect()->route('home.index')->with([
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

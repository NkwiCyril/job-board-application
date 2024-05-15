<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function register() {
        return view('auth.register');
    }

    public function register_user(Request $request) {
        $user = User::create([
            'usertype' => $request->usertype,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone_number' => $request->phone_number,
            'category' => $request->category,
            'logged_in' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        return redirect()->route('auth.login')->with('success','Registeration Successfully. Now Login!');
        
    }
}
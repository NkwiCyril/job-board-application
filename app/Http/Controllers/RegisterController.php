<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
class RegisterController extends Controller
{

    public function index () {
        return view('auth.register');
    }

    public function register (Request $request) {

        // validate all inputs
        $valid_request = $request->validate([
            'usertype' => 'required|string', // Validate usertype as required and a string
            'name' => 'required|string|max:50', // Validate name as required and a string with max length 50
            'email' => 'required|email|max:255', // Validate email as required, valid email format, and max length 255
            'password' => 'required|string|min:8|confirmed', // Validate password as required, string, min length 8, and should match confirm_password
            'phone_number' => 'required|string|min:9|max:20', // Validate phone number as required, string, min length 9, and max length 20
            'category' => 'nullable|string', // Validate category as an optional string with max length 255
        ]);

        $user = User::create([
            'usertype' => $valid_request['usertype'],
            'name' => $valid_request['name'],
            'email' => $valid_request['email'],
            'password' => bcrypt($valid_request['password']),
            'phone_number' => $valid_request['phone_number'],
            'category' => $valid_request['category'],
            'logged_in' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        if ($user) {
            return redirect()->route('auth.login')->with('success','Registration Successfully. Now Login!');
        }
    }
}
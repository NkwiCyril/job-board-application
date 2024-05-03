<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $usertype;

    public function __construct(Request $request) {
        $this->usertype = $request;
    }

    // user render user login form; for both seeker and company
    public function login() {
        return view('auth.login');
    }
    
    // for user to choose role in the platform (seeker or company)
    public function register_type() {
        return view('auth.choose_type');
    }
    
    // go to the view form of a specific usertype 
    public function register_type_post() {
        return view('auth.register_'.$this->usertype->input('usertype'));

    }

    // for user to logout of account; general for both roles
    public function logout() {
        return view('auth.login');
    }
}

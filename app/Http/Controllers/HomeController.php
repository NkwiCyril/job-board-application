<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index () {
        return view('pages.welcome');
    }

    public function user_home () {
        return view('pages.landing');
    }

    public function  company_home () {
        return view('pages.company');
    }

    public function seeker_home () {
        return view('pages.seeker');
    }
}

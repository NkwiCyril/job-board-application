<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index () {
        return view('pages.welcome');
    }

    public function user_home () {
        $opportunities = Opportunity::all();
        // dd($oppotunities);
        return view('pages.home', [
            'opportunities' => $opportunities
        ]);
    }
}
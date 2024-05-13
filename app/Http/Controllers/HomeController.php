<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Opportunity;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index () {
        return view('pages.welcome');
    }

    public function user_home () {
        $opportunities = Opportunity::all()->where('published_at', !null);

        // get published and unpublished opportunities for each company
        $published_opportunities = Opportunity::all()->where('published_at', !null);
        $unpublished_opportunities = Opportunity::all()->where('published_at', null);


        return view('pages.home', [
            'opportunities' => $opportunities,
            'published_opportunities' => $published_opportunities,
            'unpublished_opportunities' => $unpublished_opportunities,
        ]);
    }
}
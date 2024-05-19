<?php

namespace App\Http\Controllers;
use App\Models\Opportunity;
use App\Http\Controllers\Controller;


class HomeController extends Controller
{
    public function index () {
        return view('pages.welcome');
    }

    public function home () {
        $opportunities = Opportunity::all()->where('published_at', !null);

        $published_opportunities = Opportunity::all()->where('published_at', !null);
        $unpublished_opportunities = Opportunity::all()->where('published_at', null);


        return view('pages.home', [
            'opportunities' => $opportunities,
            'published_opportunities' => $published_opportunities,
            'unpublished_opportunities' => $unpublished_opportunities,
        ]);
    }
}
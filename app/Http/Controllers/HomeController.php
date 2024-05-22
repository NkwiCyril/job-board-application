<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{

    public function index (): View
    {
        $opportunities = Opportunity::all()->where('published_at', ! null);

        $published_opportunities = Opportunity::all()->where('published_at', ! null);
        $unpublished_opportunities = Opportunity::all()->where('published_at', null);

        return view('pages.home', [
            'opportunities' => $opportunities,
            'published_opportunities' => $published_opportunities,
            'unpublished_opportunities' => $unpublished_opportunities,
        ]);
    }
}

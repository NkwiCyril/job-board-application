<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{

    /**
     * Renders the homepage of each user in the application.
     */
    public function index (): View
    {
        $opportunities = Opportunity::all();

        $opps = $opportunities->where('published_at', ! null);
        $published_opps = $opportunities->where('published_at', ! null);
        $unpublished_opps = $opportunities->where('published_at', null);

        return view('pages.home', [
            'opportunities' => $opps,
            'published_opportunities' => $published_opps,
            'unpublished_opportunities' => $unpublished_opps,
        ]);
    }
}

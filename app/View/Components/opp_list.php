<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class opp_list extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public bool $company,
        public bool $seeker,
    )
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.opp_list');
    }
}

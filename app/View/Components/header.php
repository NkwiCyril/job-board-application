<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class company_header extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public bool $create, 
        public bool $publish,
    ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.company_header');
    }
}

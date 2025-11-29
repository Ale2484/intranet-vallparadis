<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GeneralServices extends Component
{
    public $generalService;
    /**
     * Create a new component instance.
     */
    public function __construct($generalService)
    {
        $this->generalService = $generalService;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.general-services');
    }
}

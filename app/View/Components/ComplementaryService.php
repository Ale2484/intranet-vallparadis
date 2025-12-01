<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ComplementaryService extends Component
{
    public $complementaryService;
    /**
     * Create a new component instance.
     */
    public function __construct($complementaryService)
    {
        $this->complementaryService = $complementaryService;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.complementary-service');
    }
}

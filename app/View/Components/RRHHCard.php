<?php

namespace App\View\Components;

use Closure;
use App\Models\RRHHTopic;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RRHHCard extends Component
{
    public $rrhh;
    /**
     * Create a new component instance.
     */
    public function __construct(RRHHTopic $rrhh)
    {
        $this->rrhh = $rrhh;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.r-r-h-h-card');
    }
}

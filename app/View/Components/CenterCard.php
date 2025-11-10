<?php

namespace App\View\Components;

use Closure;
use App\Models\Center;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CenterCard extends Component
{
    public $center;
    /**
     * Create a new component instance.
     */
    public function __construct(Center $center)
    {
        $this->center = $center;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.center-card');
    }
}

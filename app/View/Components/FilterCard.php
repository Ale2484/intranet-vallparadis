<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FilterCard extends Component
{
    public $type;
    /**
     * Create a new component instance.
     */
    public function __construct(String $type)
    {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view("components.filter-card");
    }
}

<?php

namespace App\View\Components;

use Closure;
use App\Models\Maintenance;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MaintenanceCard extends Component
{
    public $maintenance;
    /**
     * Create a new component instance.
     */
    public function __construct(Maintenance $maintenance)
    {
        $this->maintenance = $maintenance;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.maintenance-card');
    }
}

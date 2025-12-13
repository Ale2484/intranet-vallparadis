<?php

namespace App\View\Components;

use App\Models\ExternalContact;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ExternalContactCard extends Component
{
    public $externalContact;
    /**
     * Create a new component instance.
     */
    public function __construct(ExternalContact $externalContact)
    {
        $this->externalContact = $externalContact;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.external-contact-card');
    }
}

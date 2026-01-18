<?php

namespace App\View\Components\Events;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EventInfoItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $icon,
        public string $label,
        public string $value
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.events.event-info-item');
    }
}

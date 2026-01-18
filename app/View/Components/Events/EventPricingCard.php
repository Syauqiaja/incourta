<?php

namespace App\View\Components\Events;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EventPricingCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public float $price,
        public ?string $description = null,
        public bool $featured = false
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.events.event-pricing-card');
    }
}

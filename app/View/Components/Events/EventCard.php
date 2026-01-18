<?php

namespace App\View\Components\Events;

use App\Models\Event;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EventCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Event $event,
        public string $buttonText = 'Register Now',
        public ?string $buttonLink = null
    )
    {
        // Set default button link if not provided
        if (!$this->buttonLink) {
            $this->buttonLink = $this->event->slug 
                ? route('events.show', $this->event->slug)
                : '#';
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.events.event-card');
    }
}

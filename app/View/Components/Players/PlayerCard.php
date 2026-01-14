<?php

namespace App\View\Components\Players;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PlayerCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $rank,
        public string $name,
        public string $category,
        public string|int $matches,
        public string $winRate,
        public string|int $titles
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.players.player-card');
    }
}

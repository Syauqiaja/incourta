<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextField extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public string $label,
        public string $type = 'text',
        public ?string $value = null,
        public ?string $placeholder = null,
        public bool $required = false,
        public ?string $autocomplete = null,
        public bool $autofocus = false,
        public ?string $helpText = null
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.text-field');
    }
}

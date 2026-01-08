<?php

namespace App\View\Components\Input;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextField extends Component
{
    public string $name;
    public string $label;
    public string $type;
    public ?string $value;
    public ?string $placeholder;
    public bool $required;
    public ?string $autocomplete;
    public bool $autofocus;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $name,
        string $label,
        string $type = 'text',
        ?string $value = null,
        ?string $placeholder = null,
        bool $required = false,
        ?string $autocomplete = null,
        bool $autofocus = false
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->autocomplete = $autocomplete;
        $this->autofocus = $autofocus;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input.text-field');
    }
}

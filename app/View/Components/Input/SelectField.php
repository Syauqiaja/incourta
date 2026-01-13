<?php

namespace App\View\Components\Input;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectField extends Component
{
    public string $name;
    public string $label;
    public array $options;
    public ?string $value;
    public ?string $placeholder;
    public bool $required;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $name,
        string $label,
        array $options = [],
        ?string $value = null,
        ?string $placeholder = null,
        bool $required = false
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input.select-field');
    }
}

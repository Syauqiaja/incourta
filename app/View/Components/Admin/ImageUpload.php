<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ImageUpload extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name = 'images',
        public string $label = 'Upload Images',
        public int $maxFiles = 5,
        public int $maxFilesize = 2,
        public bool $required = false,
        public ?string $helpText = null,
        public ?string $uploadUrl = null,
        public array $existingFiles = []
    )
    {
        $this->uploadUrl = $uploadUrl ?? route('admin.upload.image');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.image-upload');
    }
}

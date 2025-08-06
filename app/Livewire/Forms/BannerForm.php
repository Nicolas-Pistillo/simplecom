<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class BannerForm extends Form
{
    public $banner, $imagePreview;

    #[Validate('required|image|max:4024', as: 'imagen')]
    public $image;

    #[Validate('nullable|string|max:40', as: 'nombre')]
    public $name;

    #[Validate('nullable|url', as: 'enlace')]
    public $link;

    #[Validate('required', 'boolean', as: 'publicar')]
    public $published = true;
}

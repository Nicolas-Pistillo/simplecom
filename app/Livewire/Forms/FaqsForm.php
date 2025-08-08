<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class FaqsForm extends Form
{
    public $faq;

    #[Validate('required|string|min:5|max:80', as: 'pregunta')]
    public $question;

    #[Validate('required|string|min:10|max:1000', as: 'respuesta')]
    public $response;

    #[Validate('required|boolean', as: 'publicar')]
    public $published;
}

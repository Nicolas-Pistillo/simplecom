<?php

namespace App\Livewire\Forms;

use App\Enums\MessageTopic;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Validate;
use Livewire\Form;

class IndexMessagesFilters extends Form
{
    #[Validate(['nullable', new Enum(MessageTopic::class)], as: 'tópico')]
    public $topic;

    #[Validate('nullable|boolean', as: 'sin responder')]
    public $only_unreplied;

    #[Validate('nullable|boolean', as: 'sin leer')]
    public $only_unread;

    public function isNotEmpty()
    {
        return !empty($this->topic) || !empty($this->only_unread) || !empty($this->only_unreplied);
    }
}

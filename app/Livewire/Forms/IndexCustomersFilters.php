<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class IndexCustomersFilters extends Form
{
    public $only_guest;
    public $only_registered;

    public function isNotEmpty(): bool
    {
        return $this->only_guest || $this->only_registered;
    }
}

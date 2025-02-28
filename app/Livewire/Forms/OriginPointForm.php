<?php

namespace App\Livewire\Forms;

use App\Models\OriginPoint;
use Livewire\Attributes\Validate;
use Livewire\Form;

class OriginPointForm extends Form
{
    #[Validate('required|string|max:50', as: 'nombre de punto')]
    public $name;

    #[Validate('required|min:5', as: 'nombre del encargado')]
    public $staff_name;

    #[Validate('required|email', as: 'email')]
    public $staff_email;

    #[Validate('required|size:10', as: 'telefono')]
    public $staff_phone;

    #[Validate('required|numeric|min:1000000|max:999999999', as: 'dni')]
    public $staff_document;

    public $floor, $local, $observations;

    public function fillByModel(OriginPoint $originPoint)
    {
        $this->fill([
            'name'           => $originPoint->name,
            'staff_name'     => $originPoint->staff_name,
            'staff_email'    => $originPoint->staff_email,
            'staff_phone'    => $originPoint->staff_phone,
            'staff_document' => $originPoint->staff_document,
            'floor'          => $originPoint->floor,
            'local'          => $originPoint->local,
            'observations'   => $originPoint->observations
        ]);
    }
}

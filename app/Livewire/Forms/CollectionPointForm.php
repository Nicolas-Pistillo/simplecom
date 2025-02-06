<?php

namespace App\Livewire\Forms;

use App\Models\CollectionPoint;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CollectionPointForm extends Form
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

    public function fillByModel(CollectionPoint $collectionPoint)
    {
        $this->fill([
            'name'           => $collectionPoint->name,
            'staff_name'     => $collectionPoint->staff_name,
            'staff_email'    => $collectionPoint->staff_email,
            'staff_phone'    => $collectionPoint->staff_phone,
            'staff_document' => $collectionPoint->staff_document,
            'floor'          => $collectionPoint->floor,
            'local'          => $collectionPoint->local,
            'observations'   => $collectionPoint->observations
        ]);
    }
}

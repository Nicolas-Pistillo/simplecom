<?php

namespace App\Livewire\Admin\Attributes;

use App\Models\Attribute;
use App\Models\VariantOption;
use App\Traits\Livewire\WithNotifications;
use Livewire\Component;
use Livewire\Attributes\Validate;

class Upsert extends Component
{
    use WithNotifications;
    
    #[Validate('required|string|max:25|unique:attributes,name', as: 'nuevo atributo')]
    public $newAttributeName = '';

    protected $messages = [
        'newAttributeName.unique' => 'Este nombre ya está en uso'
    ];

    public function addNewAttribute()
    {
        $this->validateOnly('newAttributeName');

        Attribute::create(['name' => $this->newAttributeName]);

        $this->notify([
            'type'  => 'success',
            'title' => 'Nuevo atributo añadido',
            'body'  => "Añadiste el atributo $this->newAttributeName"
        ]);

        $this->reset('newAttributeName');
    }

    public function deleteAttribute(Attribute $attribute)
    {
        $attribute->values()->delete();
        VariantOption::where('attribute_id', $attribute->id)->delete();
        $attribute->delete();

        $this->notify([
            'type'  => 'success',
            'title' => 'Atributo eliminado',
            'body'  => "Eliminaste el atributo $attribute->name y toda su información asociada"
        ]);
    }

    public function render()
    {
        return view('livewire.admin.attributes.upsert', [
            'attributes' => Attribute::with('values')->get()
        ]);
    }
}

<?php

namespace App\Livewire\Admin\Attributes;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\VariantOption;
use App\Traits\Livewire\WithNotifications;
use Livewire\Component;
use Livewire\Attributes\Validate;

class Upsert extends Component
{
    use WithNotifications;
    
    #[Validate('required|string|max:25|unique:attributes,name', as: 'nuevo atributo')]
    public $newAttributeName = '';

    #[Validate('required|string|max:25', as: 'nuevo valor')]
    public $newValueName;

    #[Validate('required|hex_color')]
    public $color;

    protected $messages = [
        'newAttributeValue'       => 'El nombre del nuevo valor es obligatorio',
        'newAttributeName.unique' => 'Este nombre ya está en uso',
        'color.required'          => 'Por favor, seleccione un color del cuadro'
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

    public function addNewValue(Attribute $attribute)
    {
        $this->validateOnly('newValueName');

        $newValue = new AttributeValue;
        $newValue->name = $this->newValueName;
        $newValue->attribute_id = $attribute->id;

        if ($attribute->name === 'Color')
        {
            $this->validateOnly('color');
            $newValue->meta = ['hexa_value' => $this->color];
        }

        $newValue->save();

        $this->dispatch('close-newvalue-panel');

        $this->notify([
            'type'  => 'success',
            'title' => 'Nuevo valor creado',
            'body'  => "Agregate el valor $newValue->name al atributo $attribute->name"
        ]);
    }

    public function resetNewValue()
    {
        $this->reset('newValueName', 'color');
        $this->resetErrorBag();
    }

    public function deleteValue(Attribute $attribute, AttributeValue $attributeValue)
    {
        VariantOption::where('attribute_value_id', $attributeValue->id)->delete();
        $attributeValue->delete();

        $this->dispatch('close-deletevalue-panel');

        $this->notify([
            'type'  => 'success',
            'title' => 'Valor eliminado',
            'body'  => "Eliminaste el valor $attributeValue->name del atributo $attribute->name"
        ]);
    }

    public function render()
    {
        return view('livewire.admin.attributes.upsert', [
            'attributes' => Attribute::with('values')->orderBy('name')->get()
        ]);
    }
}

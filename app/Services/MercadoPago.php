<?php 

namespace App\Services;

use App\Models\Configuration;
use App\Interfaces\Configurable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class MercadoPago implements Configurable
{
    public function getConfigurableFields(): Collection
    {
        return Configuration::whereIn('key', ['mp_access_token'])->get();
    }

    public function isConfigurated(): bool
    {
        $configurated = true;

        foreach($this->getConfigurableFields() as $field)
        {
            if ($field->required)
            {
                if ($field->input_type === 'text' && empty($field->value))
                    $configurated = false;
            }
        }

        return $configurated;
    }
}
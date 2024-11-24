<?php 

namespace App\Services;

use App\Interfaces\Configurable;
use App\Models\Configuration;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class Ualabis implements Configurable
{
    public function getConfigurableFields(): Collection
    {
        return Configuration::whereIn('key', [
            'ualabis_username', 'ualabis_client_id', 'ualabis_client_secret_id'
        ])->get();
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
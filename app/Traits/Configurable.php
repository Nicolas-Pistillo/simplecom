<?php

namespace App\Traits;

use App\Enums\InputType;
use App\Models\Configuration;
use Illuminate\Support\Collection;

trait Configurable
{
    public function getConfigurableFields(): Collection
    {
        return Configuration::whereIn('key', $this->configuration_keys)->get();
    }

    public function key($key)
    {
        return tenant()->configValue($key);
    }

    public function isConfigurated(): bool
    {
        $configurated = true;

        foreach($this->getConfigurableFields() as $field)
        {
            if ($field->required)
            {
                if ($field->input_type === InputType::Text && empty($field->value))
                    $configurated = false;
            }
        }

        return $configurated;
    }
}
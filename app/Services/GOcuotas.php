<?php 

namespace App\Services;

use App\Interfaces\Configurable;
use App\Models\Configuration;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class GOcuotas implements Configurable
{
    public function getConfigurableFields(): Collection
    {
        return Configuration::whereIn('key', ['gocuotas_api_key'])->get();
    }
}
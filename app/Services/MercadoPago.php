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
}
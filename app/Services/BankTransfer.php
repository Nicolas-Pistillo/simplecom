<?php 

namespace App\Services;

use App\Interfaces\Configurable;
use App\Models\Configuration;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class BankTransfer implements Configurable
{
    public function getConfigurableFields(): Collection
    {
        return Configuration::whereIn('key', [
            'transfer_bank', 'transfer_account_owner', 'transfer_cbu', 'transfer_alias'
        ])->get();
    }
}
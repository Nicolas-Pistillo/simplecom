<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;

interface Configurable
{
    public function getConfigurableFields(): Collection;
    public function isConfigurated(): bool;
}
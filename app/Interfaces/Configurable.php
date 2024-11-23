<?php

use Illuminate\Support\Collection;

interface Configurable
{
    public function getConfigurableFields(): Collection;
}
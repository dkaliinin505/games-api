<?php

namespace Modules\Core\Contracts\Geolocation;

use Illuminate\Database\Eloquent\Collection;

interface CountriesContract {
    public function getAll(): Collection;
}
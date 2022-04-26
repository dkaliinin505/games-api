<?php

namespace Modules\Core\Repositories\Geolocation;

use Modules\Core\Entities\Country;
use Modules\Core\Repositories\BaseRepository;

class CountriesRepository extends BaseRepository {
    public function __construct(Country $model) {
        parent::__construct($model);
    }
}
<?php

namespace Modules\Core\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Modules\Core\Contracts\Geolocation\CountriesContract;
use Modules\Core\Repositories\Geolocation\CountriesRepository;

class CountriesService implements CountriesContract {
    /**
     * @var \Modules\Core\Repositories\Geolocation\CountriesRepository
     */
    private CountriesRepository $objCountryRepository;

    /**
     * @param \Modules\Core\Repositories\Geolocation\CountriesRepository $objCountryRepository
     */
    public function __construct(CountriesRepository $objCountryRepository) {
        $this->objCountryRepository = $objCountryRepository;
    }

    public function getAll(): Collection {
        if (Cache::has("Members.Geolocation.Countries")) {
            return Cache::get("Members.Geolocation.Countries");
        }

        $arrCountries = $this->objCountryRepository->all();
        Cache::add("Members.Geolocation.Countries", $arrCountries);

        return $arrCountries;
    }
}
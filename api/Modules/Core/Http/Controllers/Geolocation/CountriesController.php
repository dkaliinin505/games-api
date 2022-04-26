<?php

namespace Modules\Core\Http\Controllers\Geolocation;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Contracts\Geolocation\CountriesContract;
use Modules\Core\Transformers\Geolocation\CountryTransformer;
use Modules\Core\Transformers\UserTransformer;

class CountriesController extends Controller {
    /**
     * @var \Modules\Core\Contracts\Geolocation\CountriesContract
     */
    private CountriesContract $objCountriesService;

    /**
     * @param \Modules\Core\Contracts\Geolocation\CountriesContract $objCountriesService
     */
    public function __construct(CountriesContract $objCountriesService) {
        $this->objCountriesService = $objCountriesService;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection {
        $arrCountries = $this->objCountriesService->getAll();

        return CountryTransformer::collection($arrCountries);
    }
}

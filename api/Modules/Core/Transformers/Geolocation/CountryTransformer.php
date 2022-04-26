<?php

namespace Modules\Core\Transformers\Geolocation;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryTransformer extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request) {
        return [
            "name"            => $this->name,
            "flag"             => $this->flag,
            "iso2"            => $this->iso2_code,
            "iso3"            => $this->iso3_code,
            "dial_code"       => $this->dial_code,
            "currency_code"   => $this->currency_code,
            "currency_name"   => $this->currency_name,
            "currency_symbol" => $this->currency_symbol,
        ];
    }
}

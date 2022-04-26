<?php

namespace Modules\Core\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class UserTransformer extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request) {
        return [
            "slug"                  => $this->slug,
            "name"                  => $this->name,
            "email"                 => $this->email,
            "email_verified"         => !is_null($this->email_verified_at),
            "phone_number"          => $this->phone_number,
            "phone_number_verified"  => !is_null($this->phone_number_verified_at),
            "avatar"                => $this->avatar,
            "balance"               => doubleval($this->balance),
            "created_at"            => $this->created_at,
            "updated_at"            => $this->updated_at,
        ];
    }
}

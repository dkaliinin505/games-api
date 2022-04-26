<?php

namespace Modules\Core\Transformers\Security;

use Illuminate\Http\Resources\Json\JsonResource;

class CreateOtpTransformer extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request) {
        return [
            "type"       => $this->type,
            "expired_at" => $this->expired_at,
        ];
    }
}

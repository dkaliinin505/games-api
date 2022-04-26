<?php

namespace Modules\Core\Http\Requests\Security;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Core\Enum\Security\OtpTypes;

class ValidateOtpRequest extends FormRequest {
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @throws \Modules\Core\Exceptions\EnumDoesntExist
     */
    public function rules() {
        return [
            "type" => ["required", "string", Rule::in(enum_values(OtpTypes::class))],
            "otp_value" => "required|string|size:6"
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }
}

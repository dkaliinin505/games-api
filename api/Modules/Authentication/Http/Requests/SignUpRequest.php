<?php

namespace Modules\Authentication\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Rules\Recaptcha;

class SignUpRequest extends FormRequest {
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            "name"      => "required|string|min:1|max:99",
            "email"     => "required|email|max:99|unique:users,email",
            "password"  => "required|string|min:6|confirmed",
            "recaptcha" => ["required", "string", new Recaptcha()],
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

    public function messages() {
        return [
            "name.required"      => "Name field is required.",
            "name.string"        => "Name field must be a string.",
            "name.min"           => "Name should contain at least 1 character.",
            "name.max"           => "Reached limit of 99 characters.",
            "email.required"     => "Email field is required.",
            "email.email"        => "Email must be email.",
            "email.max"          => "Reached limit of 99 characters.",
            "email.unique"       => "This email is already in use.",
            "password.required"  => "Password field is required.",
            "password.string"    => "Password field must be a string.",
            "password.min"       => "Name should contain at least 1 character.",
            "password.confirmed" => "Password confirmation miss match.",
        ];
    }
}

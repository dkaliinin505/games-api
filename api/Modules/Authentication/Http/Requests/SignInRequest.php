<?php

namespace Modules\Authentication\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignInRequest extends FormRequest {
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            "email"    => "required|email|exists:users,email",
            "password" => "required|string",
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
            "email.required"    => "Email field is required.",
            "email.email"       => "Email must be email.",
            "email.exists"      => "The provided credentials are incorrect.",
            "password.required" => "Password field is required.",
            "password.string"   => "Password field must be a string.",
        ];
    }
}

<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest {
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            "name"  => "required|string",
            "email" => ["required", "string", "email", Rule::unique("users", "email")->ignore(Auth::id())],
            "phone" => ["string", "nullable", Rule::unique("users", "phone_number")->ignore(Auth::id())],
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

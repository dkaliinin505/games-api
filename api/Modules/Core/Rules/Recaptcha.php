<?php

namespace Modules\Core\Rules;

use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\Rule;

class Recaptcha implements Rule {
    const VERIFY_URL = "https://www.google.com/recaptcha/api/siteverify";

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function passes($attribute, $value) {
        /** @var Client $objHttp */
        $objHttp = resolve(Client::class);

        $objResponse = $objHttp->post(self::VERIFY_URL, [
            "form_params" => [
                "secret"   => env("RECAPTCHA_SECRET"),
                "response" => $value,
            ],
        ]);

        $arrResponse = json_decode($objResponse->getBody()->getContents(), JSON_OBJECT_AS_ARRAY);

        return $arrResponse["success"];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message() {
        return 'Invalid Recaptcha.';
    }
}

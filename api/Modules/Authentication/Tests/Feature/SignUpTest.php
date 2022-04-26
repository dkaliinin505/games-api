<?php

namespace Modules\Authentication\Tests\Feature;

use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SignUpTest extends TestCase {
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSignUp() {
        $objFaker = Factory::create();
        $strPwd = "12345678";

        $arrSignUpData = [
            "name"                  => $objFaker->name,
            "email"                 => $objFaker->email,
            "password"              => $strPwd,
            "password_confirmation"  => $strPwd,
        ];

        $response = $this->post('/auth/register', $arrSignUpData);
        dd($response->getContent());
        $response->assertStatus(200);
    }
}

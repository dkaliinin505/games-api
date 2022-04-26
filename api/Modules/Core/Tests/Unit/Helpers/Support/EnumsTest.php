<?php

namespace Modules\Core\Tests\Unit\Helpers\Support;

use Modules\Core\Exceptions\EnumDoesntExist;
use Modules\Core\Helpers\Support\Enums;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EnumsTest extends TestCase {
    /**
     * A basic unit test example.
     *
     * @return void
     * @throws \Modules\Core\Exceptions\EnumDoesntExist
     */
    public function testEnumGetValues() {
        $arrValues = Enums::getValues(TestEnum::class);

        $this->assertIsArray($arrValues);
        $this->assertCount(3, $arrValues);
        $this->assertEquals(["one", "two", "three"], $arrValues);
    }

    public function testEnumGetValuesException() {
        $this->expectException(EnumDoesntExist::class);
        $this->expectExceptionMessage("Enum Not Found.");
        $this->expectExceptionCode(400);

        Enums::getValues("");
    }
}

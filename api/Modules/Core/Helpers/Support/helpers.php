<?php

use Modules\Core\Helpers\Support\Enums;

if (!function_exists("enum_values")) {
    /**
     * Get All Values Of Enum Cases
     *
     * @param string $enum
     * @return array
     * @throws \Modules\Core\Exceptions\EnumDoesntExist
     */
    function enum_values(string $enum): array {
        return Enums::getValues($enum);
    }
}
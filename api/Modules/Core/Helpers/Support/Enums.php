<?php

namespace Modules\Core\Helpers\Support;

use Modules\Core\Exceptions\EnumDoesntExist;

class Enums {
    /**
     * @param string $enum
     * @return array
     * @throws \Modules\Core\Exceptions\EnumDoesntExist
     */
    public static function getValues(string $enum): array {
        if (!enum_exists($enum)) {
            throw new EnumDoesntExist();
        }

        return collect($enum::cases())->pluck("value")->toArray();
    }
}
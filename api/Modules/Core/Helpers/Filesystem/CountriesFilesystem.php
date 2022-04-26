<?php

namespace Modules\Core\Helpers\Filesystem;

use Illuminate\Contracts\Filesystem\Filesystem;
use Modules\Core\Entities\Country;
use Modules\Core\Enum\Filesystem\Countries;

class CountriesFilesystem extends BaseFilesystem {
    public static function getFlagsPath(): string {
        return Countries::COUNTRIES_ROOT_DIR->value;
    }

    public static function getCountryFlagsDir(Country $objCountry): string {
        return sprintf(Countries::COUNTRY_FLAGS_DIR->value, $objCountry->iso2_code);
    }

    public static function saveSvgFlag(Country $objCountry, string $resource): string {
        /** @var Filesystem $objFilesystem */
        $objFilesystem = resolve(Filesystem::class);
        $strFlagPath = sprintf(Countries::COUNTRY_SVG_FLAG->value, $objCountry->iso2_code);

        $objFilesystem->put($strFlagPath, $resource);

        return $objFilesystem->path($strFlagPath);
    }

    public static function savePngFlag(Country $objCountry, string $resource): string {
        /** @var Filesystem $objFilesystem */
        $objFilesystem = resolve(Filesystem::class);
        $strFlagPath = sprintf(Countries::COUNTRY_PNG_FLAG->value, $objCountry->iso2_code);

        $objFilesystem->put($strFlagPath, $resource);

        return $objFilesystem->path($strFlagPath);
    }

    public static function flagUrl(Country $objCountry): string {
        $objFilesystem = resolve(Filesystem::class);
        $strFlagPath = sprintf(Countries::COUNTRY_SVG_FLAG->value, $objCountry->iso2_code);

        return $objFilesystem->url($strFlagPath);
    }
}
<?php

namespace Modules\Core\Enum\Filesystem;

enum Countries: string {
    case COUNTRIES_ROOT_DIR = "/geo/countries";
    case COUNTRY_FLAGS_DIR = "/geo/countries/%s";

    case COUNTRY_SVG_FLAG = "/geo/countries/%s/flag.svg";
    case COUNTRY_PNG_FLAG = "/geo/countries/%s/flag.png";
}
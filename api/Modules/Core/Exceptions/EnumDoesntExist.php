<?php

namespace Modules\Core\Exceptions;

use Throwable;

class EnumDoesntExist extends \Exception {
    public function __construct() {
        parent::__construct("Enum Not Found.", 400);
    }
}
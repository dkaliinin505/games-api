<?php

namespace Modules\Core\Enum\Security;

enum OtpTypes: string{
    case EMAIL = "email";
    case PHONE_NUMBER = "phone_number";
    case WITHDRAWAL = "withdrawal";
}
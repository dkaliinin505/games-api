<?php

namespace Modules\Core\Enum\User;

enum UserTypes: string {
    case USER = "user";
    case ADMIN = "admin";
    case DEVELOPER = "developer";
}
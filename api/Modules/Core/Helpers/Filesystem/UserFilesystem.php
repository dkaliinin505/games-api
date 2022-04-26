<?php

namespace Modules\Core\Helpers\Filesystem;

use Illuminate\Contracts\Filesystem\Filesystem;
use Modules\Core\Entities\User;
use Modules\Core\Enum\Filesystem\User as UserPaths;

class UserFilesystem {
    public static function getUserAvatar(User $objUser): string {
        $objFilesystem = resolve(Filesystem::class);

        if ($objFilesystem->exists(sprintf(UserPaths::AVATAR->value, $objUser->id))) {
            return $objFilesystem->url(sprintf(UserPaths::AVATAR->value, $objUser->id));
        }

        return $objFilesystem->url(UserPaths::DEFAULT_AVATAR->value);
    }
}
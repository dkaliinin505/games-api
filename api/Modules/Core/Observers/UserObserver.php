<?php

namespace Modules\Core\Observers;

use Illuminate\Support\Facades\Cache;
use Modules\Core\Entities\User;

class UserObserver {
    public function created(User $objUser) {
        Cache::forever("Members.Core.User.{$objUser->id}", $objUser);
    }
}

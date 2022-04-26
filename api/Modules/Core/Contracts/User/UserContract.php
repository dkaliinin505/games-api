<?php

namespace Modules\Core\Contracts\User;

use Modules\Core\Entities\User;
use Modules\Core\Enum\User\UserTypes;

interface UserContract {
    public function create(array $arrData, UserTypes $objType): User;

    public function findByEmail(string $strEmail): ?User;

    public function checkUserPassword(User $objUser, string $strPassword): bool;

    public function edit(User $objUser, array $arrData): User;
}
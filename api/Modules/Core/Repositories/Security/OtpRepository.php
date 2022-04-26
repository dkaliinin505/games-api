<?php

namespace Modules\Core\Repositories\Security;

use Modules\Core\Entities\OtpCode;
use Modules\Core\Entities\User;
use Modules\Core\Repositories\BaseRepository;

class OtpRepository extends BaseRepository {
    public function __construct(OtpCode $model) {
        parent::__construct($model);
    }

    /**
     * @param \Modules\Core\Entities\User $objUser
     * @param string $strCode
     * @return \Modules\Core\Entities\OtpCode|null
     */
    public function findByCode(User $objUser, string $strCode): ?OtpCode {
        return $objUser->verifications()->where("")->first();
    }
}
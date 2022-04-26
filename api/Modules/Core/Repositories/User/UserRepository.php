<?php

namespace Modules\Core\Repositories\User;

use Modules\Core\Entities\User;
use Modules\Core\Repositories\BaseRepository;

class UserRepository extends BaseRepository {
    public function __construct(User $model) {
        parent::__construct($model);
    }

    public function findByEmail(string $strEmail): ?User {
        return $this->model->where("email", $strEmail)->first();
    }
}
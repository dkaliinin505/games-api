<?php

namespace Modules\Core\Services\User;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;
use Modules\Core\Entities\User;
use Modules\Core\Enum\User\UserTypes;
use Modules\Core\Contracts\User\UserContract;
use Modules\Core\Repositories\User\UserRepository;

class UserService implements UserContract {
    /**
     * @var \Modules\Core\Repositories\User\UserRepository
     */
    private UserRepository $objUserRepository;

    /**
     * @param \Modules\Core\Repositories\User\UserRepository $objUserRepository
     */
    public function __construct(UserRepository $objUserRepository) {
        $this->objUserRepository = $objUserRepository;
    }

    /**
     * @param array $arrData
     * @param \Modules\Core\Enum\User\UserTypes $objType
     * @return \Modules\Core\Entities\User
     */
    public function create(array $arrData, UserTypes $objType): User {
        if (!Arr::has($arrData, ["name", "email", "password"])) {
            throw new InvalidArgumentException("Invalid User Data.", 400);
        }

        $arrData["password"] = Hash::make($arrData["password"]);
        $arrData["type"] = $objType->value;

        return $this->objUserRepository->create($arrData);
    }

    public function findByEmail(string $strEmail): ?User {
        return $this->objUserRepository->findByEmail($strEmail);
    }

    public function checkUserPassword(User $objUser, string $strPassword): bool {
        return Hash::check($strPassword, $objUser->password);
    }

    /**
     * @param \Modules\Core\Entities\User $objUser
     * @param array $arrData
     * @return \Modules\Core\Entities\User
     */
    public function edit(User $objUser, array $arrData): User {
        $arrUpdateData = [
            "name" => $arrData["name"]
        ];

        if (array_key_exists("email", $arrData) && $arrData["email"] !== $objUser->email) {
            $arrUpdateData["email"] = $arrData["email"];
            $arrUpdateData["email_verified_at"] = null;
        }

        if (array_key_exists("phone", $arrData) && $arrData["phone"] !== $objUser->phone_number) {
            $arrUpdateData["phone_number"] = $arrData["phone"];
            $arrUpdateData["phone_number_verified_at"] = null;
        }

        return $this->objUserRepository->update($objUser, $arrUpdateData);
    }
}
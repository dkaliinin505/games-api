<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Contracts\User\UserContract;
use Modules\Core\Transformers\UserTransformer;
use Modules\User\Http\Requests\UserUpdateRequest;

class UserController extends Controller {
    /**
     * @var \Modules\Core\Contracts\User\UserContract
     */
    private UserContract $objUserService;

    /**
     * @param \Modules\Core\Contracts\User\UserContract $objUserService
     */
    public function __construct(UserContract $objUserService) {
        $this->objUserService = $objUserService;
    }

    /**
     * Display a listing of the resource.
     * @return \Modules\Core\Transformers\UserTransformer
     */
    public function getAuthUser(): UserTransformer {
        /** @var \Modules\Core\Entities\User $objUser */
        $objUser = Auth::user();

        return new UserTransformer($objUser);
    }

    /**
     * @param \Modules\User\Http\Requests\UserUpdateRequest $objRequest
     * @return \Modules\Core\Transformers\UserTransformer
     */
    public function changeUserInfo(UserUpdateRequest $objRequest): UserTransformer {
        /** @var \Modules\Core\Entities\User $objUser */
        $objUser = Auth::user();

        $objUser = $this->objUserService->edit($objUser, $objRequest->only("name", "email", "phone"));

        return new UserTransformer($objUser);
    }
}

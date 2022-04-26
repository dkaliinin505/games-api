<?php

namespace Modules\Authentication\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use Modules\Authentication\Http\Requests\SignInRequest;
use Modules\Authentication\Http\Requests\SignUpRequest;
use Modules\Core\Contracts\Http\UserAgentContract;
use Modules\Core\Contracts\User\UserContract;
use Modules\Core\Enum\User\UserTypes;
use Modules\Core\Transformers\UserTransformer;

class AuthenticationController extends Controller {
    /**
     * @var \Modules\Core\Contracts\User\UserContract
     */
    private UserContract $objUserService;
    /**
     * @var \Modules\Core\Contracts\Http\UserAgentContract
     */
    private UserAgentContract $objUserAgentService;

    /**
     * @param \Modules\Core\Contracts\User\UserContract $objUserService
     * @param \Modules\Core\Contracts\Http\UserAgentContract $objUserAgentService
     */
    public function __construct(UserContract $objUserService, UserAgentContract $objUserAgentService) {
        $this->objUserService = $objUserService;
        $this->objUserAgentService = $objUserAgentService;
    }

    /**
     * @param \Modules\Authentication\Http\Requests\SignUpRequest $objRequest
     * @return \Modules\Core\Transformers\UserTransformer
     */
    public function signUp(SignUpRequest $objRequest) {
        $objUser = $this->objUserService->create($objRequest->only("name", "email", "password"), UserTypes::USER);
        $strTokenName = $this->objUserAgentService->getSessionPlatform();
        $objToken = $objUser->createToken($strTokenName);

        return (new UserTransformer($objUser))->additional(['meta' => [
            'token' => $objToken->plainTextToken,
        ]]);
    }

    /**
     * @param \Modules\Authentication\Http\Requests\SignInRequest $objRequest
     * @return \Modules\Core\Transformers\UserTransformer
     * @throws \Illuminate\Validation\ValidationException
     */
    public function signIn(SignInRequest $objRequest) {
        $objUser = $this->objUserService->findByEmail($objRequest->input("email"));

        if (is_null($objUser)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        if (!$this->objUserService->checkUserPassword($objUser, $objRequest->input("password"))) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $strTokenName = $this->objUserAgentService->getSessionPlatform();
        $objToken = $objUser->createToken($strTokenName);

        return (new UserTransformer($objUser))->additional(['meta' => [
            'token' => $objToken->plainTextToken,
        ]]);
    }
}

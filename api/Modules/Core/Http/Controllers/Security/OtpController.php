<?php

namespace Modules\Core\Http\Controllers\Security;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Contracts\Security\OtpContract;
use Modules\Core\Enum\Security\OtpTypes;
use Modules\Core\Http\Requests\Security\CreateOtpRequest;
use Modules\Core\Http\Requests\Security\ValidateOtpRequest;
use Modules\Core\Transformers\Security\CreateOtpTransformer;

class OtpController extends Controller {
    /**
     * @var \Modules\Core\Contracts\Security\OtpContract
     */
    private OtpContract $otpService;

    /**
     * @param \Modules\Core\Contracts\Security\OtpContract $otpService
     */
    public function __construct(OtpContract $otpService) {
        $this->otpService = $otpService;
    }

    /**
     * @param \Modules\Core\Http\Requests\Security\CreateOtpRequest $objRequest
     * @return \Modules\Core\Transformers\Security\CreateOtpTransformer
     */
    public function create(CreateOtpRequest $objRequest): CreateOtpTransformer {
        /** @var \Modules\Core\Entities\User $objUser */
        $objUser = Auth::user();

        $objOtp = $this->otpService->findActiveByType($objUser, OtpTypes::from($objRequest->input("type")));

        if (is_null($objOtp)) {
            $objOtp = $this->otpService->create($objUser, OtpTypes::from($objRequest->input("type")));
        }

        return new CreateOtpTransformer($objOtp);
    }

    public function validate(ValidateOtpRequest $objRequest) {

    }
}

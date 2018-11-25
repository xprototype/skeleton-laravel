<?php

namespace App\Http\Controllers\Api\Auth;

use App\Exceptions\ErrorValidation;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class Me
 * @package App\Http\Controllers\Api\Auth
 */
class Me extends ApiController
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorValidation
     */
    public function __invoke(Request $request)
    {
        $auth = auth();
        if ($auth->guest()) {
            throw new ErrorValidation(['session' => 'required']);
        }

        return $this->answerSuccess($auth->user());
    }
}

<?php

namespace App\Http\Controllers\Api\Auth;

use App\Domains\Admin\User\UserRepository;
use App\Exceptions\ErrorValidation;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\JsonResponse;

/**
 * Class Activate
 * @package App\Http\Controllers\Api\Auth
 */
class Activate extends ApiController
{
    /**
     * Refresh a token.
     *
     * @param string $code
     * @return JsonResponse
     * @throws ErrorValidation
     */
    public function __invoke($code)
    {
        if (!$code) {
            throw new ErrorValidation(['code' => 'required']);
        }
        $user = UserRepository::instance()->findByRememberToken($code);
        if (!$user) {
            throw new ErrorValidation(['code' => 'invalid']);
        }
        return $this->answerSuccess(['email' => $user->getValue('email')]);
    }
}

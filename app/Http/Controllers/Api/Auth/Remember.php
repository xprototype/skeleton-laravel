<?php

namespace App\Http\Controllers\Api\Auth;

use App\Domains\Admin\User\UserRepository;
use App\Exceptions\ErrorValidation;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class Remember
 * @package App\Http\Controllers\Api\Auth
 */
class Remember extends ApiController
{
    /**
     * Refresh a token.
     *
     * @param Request $request
     * @param UserRepository $userRepository
     * @return JsonResponse
     * @throws ErrorValidation
     */
    public function __invoke(Request $request, UserRepository $userRepository)
    {
        $login = $request->get('login');
        if (!$login) {
            throw new ErrorValidation(['login' => 'required']);
        }

        $user = $userRepository->findByEmail($login);
        if (!$user) {
            throw new ErrorValidation(['login' => 'undefined']);
        }

        $success = $userRepository->createResetPassword($login);
        if ($success) {
            return $this->answerSuccess($login);
        }
        return $this->answerError("Can't reset the password of '{$login}'");
    }
}

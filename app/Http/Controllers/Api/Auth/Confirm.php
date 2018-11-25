<?php

namespace App\Http\Controllers\Api\Auth;

use App\Domains\Admin\User;
use App\Domains\Admin\User\UserRepository;
use App\Domains\Common\Model;
use App\Exceptions\ErrorResourceIsGone;
use App\Exceptions\ErrorValidation;
use App\Http\Controllers\Api\ApiController;
use App\Http\Status;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class Confirm
 * @package App\Http\Controllers\Api\Auth
 */
class Confirm extends ApiController
{
    /**
     * @param Request $request
     * @param UserRepository $userRepository
     * @return JsonResponse
     * @throws ErrorResourceIsGone
     * @throws ErrorValidation
     * @throws \Exception
     */
    public function __invoke(Request $request, UserRepository $userRepository)
    {
        $password = $request->post('password');
        $confirm = $request->post('confirm');

        $this->validatePassword($password, $confirm);

        $activation = $request->post('activation');
        if ($activation) {
            $user = $userRepository->findByRememberToken($activation);
            $details = ['activation' => 'invalid'];

            return $this->answer($user, $password, $details);
        }

        $token = $request->post('token');
        if ($token) {
            $user = $userRepository->findByResetToken($token);
            $details = ['token' => 'invalid'];
            if ($user) {
                $userRepository->destroyResetPassword($token, $password);
            }

            return $this->answer($user, $password, $details);
        }

        throw new ErrorValidation(['reference' => 'invalid']);
    }

    /**
     * @param Model $user
     * @param string $password
     * @param array $details
     * @return JsonResponse
     * @throws ErrorResourceIsGone
     */
    protected function answer($user, $password, $details)
    {
        /** @var User $user */
        if (isset($user) && $user) {
            $user->password = $password;
            $user->remember_token = '';
            $user->active = true;
            $user->save();

            return $this->answerSuccess(['user' => $user->id], Status::CODE_200);
        }
        throw new ErrorResourceIsGone($details);
    }

    /**
     * @param string $password
     * @param string $confirm
     * @throws ErrorValidation
     */
    private function validatePassword($password, $confirm)
    {
        if (!$password or !$confirm) {
            $details = [];
            if (!$password) {
                $details['password'] = 'required';
            }
            if (!$confirm) {
                $details['confirm'] = 'required';
            }
            throw new ErrorValidation($details);
        }

        if ($password !== $confirm) {
            throw new ErrorValidation(['confirm' => 'sameAs(password)']);
        }
    }
}

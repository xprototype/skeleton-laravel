<?php

namespace App\Http\Controllers\Api\Auth;

use App\Domains\Admin\User;
use App\Domains\Admin\User\UserRepository;
use App\Exceptions\ErrorRuntime;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class Register
 * @package App\Http\Controllers\Api\Auth
 */
class Register extends ApiController
{
    /**
     * @param Request $request
     * @param UserRepository $userRepository
     * @return JsonResponse
     * @throws ErrorRuntime
     */
    public function __invoke(Request $request, UserRepository $userRepository)
    {
        /** @var User $user */
        $id = $userRepository->create([
            'email' => $request->post('email'),
            'firstName' => $request->post('firstName'),
            'lastName' => $request->post('lastName'),
            'birthday' => $request->post('birthday'),
            'gender' => $request->post('gender'),
        ]);

        $user = $userRepository->findById($id);

        if (!$user) {
            throw new ErrorRuntime(['error' => "Error on register user"]);
        }

        $data = 'registered';
        if (env('APP_DEV')) {
            $data = ['email' => $user->email, 'activation' => $user->remember_token];
        }

        return $this->answerSuccess($data);
    }
}

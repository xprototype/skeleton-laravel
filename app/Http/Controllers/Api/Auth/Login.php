<?php

namespace App\Http\Controllers\Api\Auth;

use App\Domains\Auth\Login as User;
use App\Exceptions\ErrorUserInative;
use App\Exceptions\ErrorUserLocked;
use App\Exceptions\ErrorUserUnauthorized;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class Login
 * @package App\Http\Controllers\Api\Auth
 */
class Login extends ApiController
{
    /**
     * @see ThrottlesLogins
     */
    use ThrottlesLogins;

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorUserUnauthorized
     * @throws ErrorUserInative
     * @throws ErrorUserLocked
     */
    public function __invoke(Request $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            throw new ErrorUserLocked(['user' => 'locked']);
        }

        $login = $request->post('login');
        $password = $request->post('password');

        $user = User::where('email', $login)->first();

        if (is_null($user)) {
            $this->incrementLoginAttempts($request);

            throw new ErrorUserUnauthorized(['credentials' => 'unknown']);
        }

        if (!Hash::check($password, $user->password)) {
            $this->incrementLoginAttempts($request);

            throw new ErrorUserUnauthorized(['credentials' => 'invalid']);
        }

        if (!$user->active) {
            throw new ErrorUserInative(['user' => 'inative']);
        }

        $customClaims = [
            'session' => uniqid()
        ];
        /** @noinspection PhpUndefinedMethodInspection */
        $token = JWTAuth::claims($customClaims)->fromUser($user);

        if (!$token) {
            throw new ErrorUserUnauthorized(['credentials' => 'invalid']);
        }

        /** @noinspection PhpUndefinedMethodInspection */
        $token_expires_at = JWTAuth::setToken($token)->getPayload()->get('exp');

        /** @noinspection PhpUndefinedFieldInspection */
        return $this->answerSuccess([
            'token' => $token,
            'token_type' => 'bearer',
            'token_expires_at' => $token_expires_at,
            '$user' => [
                'id' => $user->id,
                'email' => $user->email,
                'firstName' => $user->firstName,
                'lastName' => $user->lastName,
                'name' => $user->name,
                'photo' => $user->photo,
            ],
        ]);
    }

    /**
     * @return string
     */
    public function username()
    {
        return 'email';
    }
}

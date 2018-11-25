<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class Refresh
 * @package App\Http\Controllers\Api\Auth
 */
class Refresh extends ApiController
{
    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function __invoke()
    {
        $auth = auth();

        /** @noinspection PhpUndefinedMethodInspection */
        $token = $auth->refresh();

        /** @noinspection PhpUndefinedMethodInspection */
        $payload = $auth->payload();

        /** @noinspection PhpUndefinedMethodInspection */
        $token_expires_at = JWTAuth::setToken($token)->getPayload()->get('exp');

        /** @noinspection PhpUndefinedMethodInspection */
        return $this->answerSuccess([
            'token' => $token,
            'token_type' => 'bearer',
            'token_expires_at' => $token_expires_at,
            'session' => $payload->get('session'),
        ]);
    }
}

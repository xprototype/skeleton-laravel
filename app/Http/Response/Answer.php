<?php

namespace App\Http\Response;

use App\Http\Status;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

/**
 * Class Answer
 * @package App\Http\Response
 */
abstract class Answer
{
    /**
     * @param mixed $data
     * @param int $code
     * @return JsonResponse
     */
    public static function success($data, $code = Status::CODE_200)
    {
        $response = [
            'status' => 'success',
            'data' => $data,
        ];
        return Response::json($response, $code);
    }

    /**
     * @param mixed $data
     * @param int $code
     * @return JsonResponse
     */
    public static function fail($data, $code = Status::CODE_400)
    {
        $response = [
            'status' => 'fail',
            'data' => $data,
        ];
        return Response::json($response, $code);
    }

    /**
     * @param string $message
     * @param int $code
     * @param mixed $data
     * @param mixed $debug
     * @return JsonResponse
     */
    public static function error($message, $code = Status::CODE_500, $data = null, $debug = null)
    {
        $response = [
            'status' => 'error',
            'message' => $message,
        ];

        if (!is_null($code)) {
            $response['code'] = $code;
        }

        if (!is_null($data)) {
            $response['data'] = $data;
        }

        if (!is_null($debug)) {
            $response['$debug'] = $debug;
        }

        return Response::json($response, $code);
    }
}

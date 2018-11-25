<?php
/**
 * JSEND
 * @link https://labs.omniti.com/labs/jsend
 * |------------------------------------------------------------------------------------------------------------------|
 * | Type     | Description                                             | Required Keys          | Optional Keys      |
 * |------------------------------------------------------------------------------------------------------------------|
 * | success  | All went well, and (usually) some data was returned.    | status, data           |                    |
 * |..........|.........................................................|........................|....................|
 * | fail     | There was a problem with the data submitted, or some    | status, data           |                    |
 * |          | pre-condition of the API call wasn't satisfied          |                        |                    |
 * |..........|.........................................................|........................|....................|
 * | error    | An error occurred in processing the request, i.e. an    | status, message        | code, data         |
 * |          | exception was thrown                                    |                        |                    |
 * |------------------------------------------------------------------------------------------------------------------|
 */

namespace App\Http\Response;

use App\Http\Status;
use Illuminate\Http\JsonResponse;

/**
 * Trait AnswerTrait
 * @package App\Http\Response
 */
trait AnswerTrait
{
    /**
     * @param mixed $data
     * @param int $code
     * @return JsonResponse
     */
    public function answerSuccess($data, $code = Status::CODE_200)
    {
        return Answer::success($data, $code);
    }

    /**
     * @param mixed $data
     * @param int $code
     * @return JsonResponse
     */
    public function answerFail($data, $code = Status::CODE_400)
    {
        return Answer::fail($data, $code);
    }

    /**
     * @param string $message
     * @param int $code
     * @param mixed $data
     * @param mixed $debug
     * @return JsonResponse
     */
    public function answerError($message, $code = Status::CODE_500, $data = null, $debug = null)
    {
        return Answer::error($message, $code, $data, $debug);
    }
}

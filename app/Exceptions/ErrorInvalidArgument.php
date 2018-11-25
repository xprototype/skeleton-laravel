<?php

namespace App\Exceptions;

use App\Http\Status;

/**
 * Class ErrorInvalidArgument
 * @package App\Exceptions
 */
class ErrorInvalidArgument extends ErrorHttp
{
    /**
     * @var int
     */
    protected $statusCode = Status::CODE_500;

    /**
     * @var int
     */
    protected $defaultMessage = 'The argument is not valid';
}

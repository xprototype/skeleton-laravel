<?php

namespace App\Exceptions;

use App\Http\Status;

/**
 * Class ErrorUserUnauthorized
 * @package App\Exceptions
 */
class ErrorUserUnauthorized extends ErrorHttp
{
    /**
     * @var int
     */
    protected $statusCode = Status::CODE_401;

    /**
     * @var int
     */
    protected $defaultMessage = 'Invalid credentials';
}

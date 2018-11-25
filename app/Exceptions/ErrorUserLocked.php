<?php

namespace App\Exceptions;

use App\Http\Status;

/**
 * Class ErrorUserLocked
 * @package App\Exceptions
 */
class ErrorUserLocked extends ErrorHttp
{
    /**
     * @var int
     */
    protected $statusCode = Status::CODE_429;

    /**
     * @var int
     */
    protected $defaultMessage = 'Invalid credentials';
}

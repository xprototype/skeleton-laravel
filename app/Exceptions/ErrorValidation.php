<?php

namespace App\Exceptions;

use App\Http\Status;

/**
 * Class ErrorValidation
 * @package App\Exceptions
 */
class ErrorValidation extends ErrorHttp
{
    /**
     * @var int
     */
    protected $statusCode = Status::CODE_400;

    /**
     * @var int
     */
    protected $defaultMessage = 'Invalid input';
}

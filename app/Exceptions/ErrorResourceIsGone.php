<?php

namespace App\Exceptions;

use App\Http\Status;

/**
 * Class ErrorResourceIsGone
 * @package App\Exceptions
 */
class ErrorResourceIsGone extends ErrorHttp
{
    /**
     * @var int
     */
    protected $statusCode = Status::CODE_410;

    /**
     * @var int
     */
    protected $defaultMessage = 'Gone';
}

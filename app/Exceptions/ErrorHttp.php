<?php

namespace App\Exceptions;

use App\Http\Status;
use Exception;

/**
 * Class ErrorHttp
 * @package App\Exceptions
 */
abstract class ErrorHttp extends Exception implements ErrorInterface
{
    /**
     * @var int
     */
    protected $statusCode = Status::CODE_500;

    /**
     * @var array
     */
    protected $details = [];

    /**
     * @var int
     */
    protected $defaultMessage = 'Server error';

    /**
     * ErrorValidation constructor.
     * @param array $details
     * @param string|null $message
     * @param int|null $code
     * @param Exception|null $previous
     */
    public function __construct(
        array $details,
        string $message = null,
        ?int $code = 0,
        Exception $previous = null
    ) {
        parent::__construct($message ? $message : $this->defaultMessage, $code, $previous);

        $this->details = $details;
    }

    /**
     * @return array
     */
    public function getDetails(): array
    {
        return $this->details;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}

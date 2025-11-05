<?php

namespace Dreamscape\ResellerApiSdk\Exception;

use Dreamscape\ResellerApiSdk\Validation\Error;
use InvalidArgumentException;
use Throwable;

/**
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class ValidationException extends ResellerApiSdkException
{
    /**
     * @var Error[]
     */
    protected array $errors;

    /**
     * @param Error[] $errors
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(array $errors, int $code = 0, Throwable $previous = null)
    {
        foreach ($errors as $error) {
            if (!$error instanceof Error) {
                throw new InvalidArgumentException('All errors must be instances of ' . Error::class);
            }
        }

        $this->errors = $errors;

        parent::__construct('Validation error', $code, $previous);
    }

    /**
     * @return Error[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}

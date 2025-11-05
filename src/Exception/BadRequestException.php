<?php

namespace Dreamscape\ResellerApiSdk\Exception;

use Throwable;

/**
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class BadRequestException extends ResellerApiSdkException
{
    private array $errors;

    /**
     * @param array $errors
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(array $errors = [], string $message = '', int $code = 0, Throwable $previous = null)
    {
        $this->errors = $errors;
        $this->message = $this->formatMessage($errors);

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     *
     * @return string
     */
    private function formatMessage(array $errors): string
    {
        $message = '';

        array_walk_recursive($errors, function ($error) use (&$message) {
            $message .= $error . PHP_EOL;
        });

        return $message;
    }
}

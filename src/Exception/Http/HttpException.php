<?php

namespace Dreamscape\ResellerApiSdk\Exception\Http;

use Dreamscape\ResellerApiSdk\Http\Request;
use Dreamscape\ResellerApiSdk\Exception\ResellerApiSdkException;
use Throwable;

/**
 * Base class for HTTP exceptions.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
abstract class HttpException extends ResellerApiSdkException
{
    /**
     * Instance of HTTP request.
     *
     * @var Request
     */
    private Request $request;

    /**
     * Constructor.
     *
     * @param $message
     * @param Request $request
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message, Request $request, $code = 0, Throwable $previous = null)
    {
        $this->request = $request;

        parent::__construct($message, $code, $previous);
    }

    /**
     * Returns the instance of HTTP request.
     *
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }
}

<?php

namespace Dreamscape\ResellerApiSdk\Http\Transport;

use Dreamscape\ResellerApiSdk\Exception\Http\ConnectException;
use Dreamscape\ResellerApiSdk\Exception\Http\RequestException;
use Dreamscape\ResellerApiSdk\Http\Request;
use Dreamscape\ResellerApiSdk\Http\RequestOptions;
use Dreamscape\ResellerApiSdk\Http\Response;

/**
 * Base class for HTTP transport.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
abstract class AbstractTransport
{
    /**
     * Base URI for HTTP requests.
     *
     * @var string
     */
    protected string $base_uri;

    /**
     * HTTP request options.
     *
     * @var RequestOptions
     */
    protected RequestOptions $request_options;

    /**
     * Constructor.
     *
     * @param string $base_uri
     */
    public function __construct(string $base_uri, RequestOptions $request_options = null)
    {
        $this->request_options = $request_options ?: new RequestOptions();
        $this->base_uri = trim($base_uri, ' /');
    }

    /**
     * Executes the HTTP request and prepares the response.
     *
     * @param Request $request
     *
     * @return Response
     * @throws ConnectException
     * @throws RequestException
     */
    abstract public function request(Request $request): Response;
}

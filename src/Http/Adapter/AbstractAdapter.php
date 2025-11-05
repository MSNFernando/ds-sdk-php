<?php

namespace Dreamscape\ResellerApiSdk\Http\Adapter;

use Dreamscape\ResellerApiSdk\Authenticator\Authenticator;
use Dreamscape\ResellerApiSdk\Http\Request;
use Dreamscape\ResellerApiSdk\Http\RequestOptions;
use Dreamscape\ResellerApiSdk\Http\Response;
use Dreamscape\ResellerApiSdk\Http\Transport\AbstractTransport;
use InvalidArgumentException;

/**
 * Interface for HTTP adapters.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
abstract class AbstractAdapter
{
    protected Authenticator $authenticator;
    protected AbstractTransport $transport;

    /**
     * Constructor.
     *
     * @param Authenticator $auth
     * @param string $api_location
     * @param RequestOptions|null $request_options
     */
    public function __construct(
        Authenticator $auth,
        string $api_location,
        RequestOptions $request_options = null
    ) {
        if (empty($api_location)) {
            throw new InvalidArgumentException('The argument $api_location must be not empty string');
        }

        if (!preg_match('/^http[s]?:\/\/.*$/', $api_location)) {
            throw new InvalidArgumentException(
                'Argument $api_location has wrong format. ' .
                'It must be like: https://reseller-api.ds.network'
            );
        }

        $this->authenticator = $auth;
        $this->transport = static::initializeTransport($api_location, $request_options);
    }

    /**
     * Initializes the concrete HTTP transport.
     *
     * @param string $api_location
     * @param RequestOptions|null $request_options
     *
     * @return AbstractTransport
     */
    abstract protected static function initializeTransport(
        string $api_location,
        RequestOptions $request_options = null
    ): AbstractTransport;

    /**
     * Sends request using the selected HTTP client and returns the HTTP response.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function request(Request $request): Response
    {
        $this->authenticator->authenticate($request);

        return $this->transport->request($request);
    }
}

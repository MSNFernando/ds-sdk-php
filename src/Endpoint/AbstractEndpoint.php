<?php

namespace Dreamscape\ResellerApiSdk\Endpoint;

use Dreamscape\ResellerApiSdk\Exception\AuthenticationException;
use Dreamscape\ResellerApiSdk\Exception\BadRequestException;
use Dreamscape\ResellerApiSdk\Exception\InternalServerErrorException;
use Dreamscape\ResellerApiSdk\Exception\InvalidResponseException;
use Dreamscape\ResellerApiSdk\Exception\NotFoundException;
use Dreamscape\ResellerApiSdk\Exception\PaymentRequiredException;
use Dreamscape\ResellerApiSdk\Http\Adapter\AbstractAdapter;
use Dreamscape\ResellerApiSdk\Http\Request;
use Dreamscape\ResellerApiSdk\Http\Response;
use Dreamscape\ResellerApiSdk\RequestLogger;
use InvalidArgumentException;
use Throwable;

/**
 * Base class for API endpoints.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
abstract class AbstractEndpoint
{
    private AbstractAdapter $http_adapter;
    private ?RequestLogger $request_logger;

    /**
     * Instances of endpoints.
     *
     * @var array
     */
    private array $endpoints_instances = [];

    /**
     * Mapping of endpoint name to its class.
     *
     * @var array
     */
    protected array $endpoint_to_class_map = [];

    #region Magic

    /**
     * Constructor.
     *
     * @param AbstractAdapter $http_adapter
     * @param RequestLogger|null $request_logger
     */
    public function __construct(AbstractAdapter $http_adapter, ?RequestLogger $request_logger = null)
    {
        $this->http_adapter = $http_adapter;
        $this->request_logger = $request_logger;
    }

    /**
     * Returns the instance of API endpoint.
     *
     * @param string $name
     *
     * @return AbstractEndpoint
     */
    public function __get(string $name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException('The argument $name must be not empty string');
        }

        $name = strtolower($name);

        if (isset($this->endpoints_instances[$name])) {
            return $this->endpoints_instances[$name];
        }

        if (!isset($this->endpoint_to_class_map[$name])) {
            throw new InvalidArgumentException('There is no API endpoint with name \'' . $name . '\'');
        }

        $class_name = $this->endpoint_to_class_map[$name];

        return $this->endpoints_instances[$name] = new $class_name(
            $this->http_adapter,
            $this->request_logger
        );
    }

    #endregion

    #region Wrappers for HTTP requests

    /**
     * Sends the HTTP POST request.
     *
     * @param string $uri
     * @param array $data
     *
     * @return array
     */
    final protected function sendPostRequest(string $uri, array $data = []): array
    {
        return $this->request(
            (new Request(Request::METHOD_POST, $uri))
                ->setHeader('Content-Type', 'application/json')
                ->setBody($data)
        );
    }

    /**
     * Sends the HTTP GET request.
     *
     * @param string $uri
     * @param array $url_params
     *
     * @return array
     */
    final protected function sendGetRequest(string $uri, array $url_params = []): array
    {
        return $this->request(
            (new Request(Request::METHOD_GET, $uri))
                ->setUrlParams($url_params)
        );
    }

    /**
     * Sends the HTTP PATCH request.
     *
     * @param string $uri
     * @param array $data
     *
     * @return array
     */
    final protected function sendPatchRequest(string $uri, array $data = []): array
    {
        return $this->request(
            (new Request(Request::METHOD_PATCH, $uri))
                ->setHeader('Content-Type', 'application/json')
                ->setBody($data)
        );
    }

    /**
     * Sends the HTTP DELETE request.
     *
     * @param string $uri
     * @param array $data
     *
     * @return bool
     */
    final protected function sendDeleteRequest(string $uri, array $data = []): bool
    {
        return $this->request(
            (new Request(Request::METHOD_DELETE, $uri))
                ->setBody($data)
        );
    }

    /**
     * Sends request and handles the response.
     *
     * @param Request $request
     *
     * @return array|bool
     */
    private function request(Request $request)
    {
        $response = $this->http_adapter->request($request);
        $response_body = $response->getParsedBody();

        $this->logRequest($request, $response);

        if ($request->getUri() === 'ping') {
            return [ 'status' => $response->getStatusCode() === 200 ];
        }

        if ($response->getStatusCode() === 400) {
            if (
                is_array($response_body)
                && (
                    isset($response_body['validation_errors'])
                    || isset($response_body['error_message'])
                )
            ) {
                throw new BadRequestException(
                    $response_body['validation_errors'] ?? [ $response_body['error_message'] ]
                );
            }

            throw new BadRequestException([ 'Bad request' ]);
        }

        if ($response->getStatusCode() === 401) {
            if (is_array($response_body) && isset($response_body['error_message'])) {
                throw new AuthenticationException($response_body['error_message']);
            }

            throw new AuthenticationException('Authentication is required');
        }

        if ($response->getStatusCode() === 402) {
            if (is_array($response_body) && isset($response_body['error_message'])) {
                throw new PaymentRequiredException($response_body['error_message']);
            }

            throw new PaymentRequiredException('Payment is required');
        }

        if ($response->getStatusCode() === 404) {
            if (is_array($response_body) && isset($response_body['error_message'])) {
                throw new NotFoundException($response_body['error_message']);
            }

            throw new NotFoundException('Not found');
        }

        if ($response->getStatusCode() === 500 || $response->getStatusCode() === 502) {
            if (is_array($response_body) && isset($response_body['error_message'])) {
                throw new InternalServerErrorException($response_body['error_message']);
            }

            throw new InternalServerErrorException($response->getRawBody());
        }

        if ($request->getMethod() === Request::METHOD_DELETE && $response->getStatusCode() === 204) {
            return true;
        }

        if (
            empty($response_body)
            || !is_array($response_body)
            || !isset($response_body['status'])
            || !isset($response_body['data'])
            || isset($response_body['pagination']) && (
                !isset($response_body['pagination']['total_items'])
                || !isset($response_body['pagination']['total_pages'])
                || !isset($response_body['pagination']['current_page'])
            )
        ) {
            throw new InvalidResponseException($response->getRawBody());
        }

        return $response_body;
    }

    #endregion

    #region Request logging

    /**
     * Logs the request if the logger is attached.
     *
     * @param Request $request
     * @param Response $response
     */
    private function logRequest(Request $request, Response $response)
    {
        if ($this->request_logger === null) {
            return;
        }

        $this->request_logger->log($request, $response);
    }

    #endregion
}

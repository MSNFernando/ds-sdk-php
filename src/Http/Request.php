<?php

namespace Dreamscape\ResellerApiSdk\Http;

use InvalidArgumentException;

/**
 * Class for HTTP request (method, body, etc.).
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Request
{
    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';
    public const METHOD_PATCH = 'PATCH';
    public const METHOD_DELETE = 'DELETE';

    /**
     * HTTP request method.
     *
     * @var string
     */
    private string $method;

    /**
     * HTTP request URI.
     *
     * @var string
     */
    private string $uri;

    /**
     * HTTP request GET params.
     *
     * @var array
     */
    private array $url_params = [];

    /**
     * HTTP request headers.
     *
     * @var array
     */
    private array $headers = [];

    /**
     * HTTP request body. Can be string or array.
     *
     * @var mixed
     */
    private $body;

    /**
     * Request time.
     *
     * @var int|null
     */
    private ?int $request_time = null;

    #region Magic

    /**
     * Constructor.
     *
     * @param string $method
     * @param string $uri
     */
    public function __construct(string $method, string $uri)
    {
        if (!self::isMethodValid($method)) {
            throw new InvalidArgumentException('The argument $method has not allowed value');
        }

        if (empty($uri)) {
            throw new InvalidArgumentException('The argument $uri must be not empty string');
        }

        $this->method = $method;
        $this->uri = trim($uri, ' /');
    }

    #endregion

    #region Setters

    /**
     * Sets the GET parameters of HTTP request.
     *
     * @param array $url_params
     * [
     *      'name' => 'John',
     *      'hobbies' => [
     *          'Sport',
     *          'Games',
     *      ],
     * ]
     *
     * @return self
     */
    public function setUrlParams(array $url_params): self
    {
        foreach ($url_params as $url_param_name => $url_param_value) {
            if (empty($url_param_name) || !is_string($url_param_name)) {
                throw new InvalidArgumentException('The name of url param must be not empty string');
            }

            if (!is_scalar($url_param_value) && !is_array($url_param_value)) {
                throw new InvalidArgumentException(
                    'The value of url param \'' . $url_param_name . '\' must ' .
                    'be scalar type or be an array'
                );
            }
        }

        $this->url_params = $url_params;

        return $this;
    }

    /**
     * Overrides HTTP request headers.
     *
     * @param array $headers
     * [
     *        'Content-Type' => 'text/html',
     * ]
     *
     * @return self
     */
    public function setHeaders(array $headers): self
    {
        foreach ($headers as $header_name => $header_value) {
            if (empty($header_name) || !is_string($header_name)) {
                throw new InvalidArgumentException('The name of header must be not empty string');
            }

            if (!is_scalar($header_value)) {
                throw new InvalidArgumentException(
                    'The value of header \'' . $header_name . '\' must be scalar type'
                );
            }
        }

        $this->headers = [];

        foreach ($headers as $header_name => $header_value) {
            $this->setHeader($header_name, $header_value);
        }

        return $this;
    }

    /**
     * Sets the HTTP header.
     *
     * @param string $name
     * @param string $value
     *
     * @return self
     */
    public function setHeader(string $name, string $value): self
    {
        if (empty($name)) {
            throw new InvalidArgumentException('The argument $header_name cannot be empty');
        }

        if (empty($value)) {
            throw new InvalidArgumentException('The argument $header_value must be not empty string');
        }

        $this->headers[$name] = $value;

        return $this;
    }

    /**
     * Sets the HTTP request body.
     *
     * @param mixed $body
     *
     * @return self
     */
    public function setBody($body): self
    {
        if (!is_scalar($body) && !is_array($body)) {
            throw new InvalidArgumentException('The argument $body must have one of type: scalar, array');
        }

        if (is_array($body)) {
            foreach ($body as $key => $value) {
                if (!is_null($value)) {
                    continue;
                }

                throw new InvalidArgumentException(
                    'The item \'' . $key . '\' is null. Please do not specify null values, ' .
                    'because they are ignored in the request body'
                );
            }
        }

        $this->body = $body;

        return $this;
    }

    /**
     * Sets request time.
     *
     * @param int $time
     *
     * @return self
     */
    public function setRequestTime(int $time): self
    {
        $this->request_time = $time;

        return $this;
    }

    #endregion

    #region Getters

    /**
     * Returns the HTTP request method.
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Returns the HTTP request URI.
     *
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * Returns the HTTP request GET parameters.
     *
     * @return array
     */
    public function getUrlParams(): array
    {
        return $this->url_params;
    }

    /**
     * Returns the HTTP request headers.
     *
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Returns the HTTP request body.
     *
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Returns the request time.
     *
     * @return int|null
     */
    public function getRequestTime(): ?int
    {
        return $this->request_time;
    }

    #endregion

    #region Helpers

    /**
     * Checks is HTTP method valid.
     *
     * @param string $method
     *
     * @return bool
     */
    public static function isMethodValid(string $method): bool
    {
        if (empty($method)) {
            throw new InvalidArgumentException('The argument $method cannot be empty');
        }

        switch ($method) {
            case self::METHOD_GET:
            case self::METHOD_POST:
            case self::METHOD_PATCH:
            case self::METHOD_DELETE:
                return true;
        }

        return false;
    }

    #endregion
}

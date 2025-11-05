<?php

namespace Dreamscape\ResellerApiSdk\Http;

/**
 * Class for HTTP response (status code, body, etc.).
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Response
{
    /**
     * HTTP response status code.
     *
     * @var int
     */
    private int $status_code;

    /**
     * HTTP response headers.
     *
     * @var array
     */
    private array $headers;

    /**
     * HTTP response parsed body.
     *
     * @var mixed|null
     */
    private $parsed_body = null;

    /**
     * HTTP response raw body.
     *
     * @var string
     */
    private string $raw_body;

    /**
     * Response time.
     *
     * @var int
     */
    private int $response_time;

    /**
     * Constructor.
     *
     * @param int $status_code
     * @param array $headers
     * @param string $raw_body
     * @param int|null $response_time
     */
    public function __construct(
        int $status_code,
        array $headers,
        string $raw_body,
        int $response_time = null
    ) {
        $this->status_code = $status_code;
        $this->headers = $headers;
        $this->raw_body = $raw_body;
        $this->response_time = $response_time ?: time();

        $this->parseBody();
    }

    /**
     * Parses response body according to the content type.
     * Now it handles only JSON.
     */
    private function parseBody(): void
    {
        if (
            array_key_exists('Content-Type', $this->headers)
            && !empty($this->headers['Content-Type'])
            && preg_match('~^application/(?:json|vnd\.api\+json)~i', $this->headers['Content-Type'][0])
        ) {
            $parsed_body = json_decode($this->raw_body, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                $this->parsed_body = $parsed_body;
            }
        }
    }

    /**
     * Returns the HTTP response status code.
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->status_code;
    }

    /**
     * Returns the HTTP response headers.
     *
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Returns the HTTP response parsed body.
     *
     * @return mixed|null
     */
    public function getParsedBody()
    {
        return $this->parsed_body;
    }

    /**
     * Returns the HTTP response raw body.
     *
     * @return string
     */
    public function getRawBody(): string
    {
        return $this->raw_body;
    }

    /**
     * Returns the response time.
     *
     * @return int
     */
    public function getResponseTime(): int
    {
        return $this->response_time;
    }
}

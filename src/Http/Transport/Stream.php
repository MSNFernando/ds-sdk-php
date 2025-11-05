<?php

namespace Dreamscape\ResellerApiSdk\Http\Transport;

use Dreamscape\ResellerApiSdk\Exception\Http\ConnectException;
use Dreamscape\ResellerApiSdk\Exception\Http\RequestException;
use Dreamscape\ResellerApiSdk\Http\Request;
use Dreamscape\ResellerApiSdk\Http\RequestOptions;
use Dreamscape\ResellerApiSdk\Http\Response;
use RuntimeException;

/**
 * Class for sending HTTP request using stream and preparing HTTP response.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Stream extends AbstractTransport
{
    /**
     * Executes the HTTP request and prepares the response.
     *
     * @param Request $request
     *
     * @return Response
     * @throws ConnectException
     * @throws RequestException
     *
     * @codeCoverageIgnore
     */
    public function request(Request $request): Response
    {
        $url = $this->base_uri . '/' . $request->getUri();

        if (!empty($request->getUrlParams())) {
            if (!strpos($url, '?') !== false) {
                $url .= '?';
            } else {
                $url .= '&';
            }

            $url .= http_build_query($request->getUrlParams());
        }

        $context_options = [
            'http' => [
                'method' => $request->getMethod(),
                'ignore_errors' => true,
            ],
        ];

        if ($this->request_options->get(RequestOptions::VERIFY_SSL, true) === false) {
            $context_options['ssl']['verify_peer'] = false;
            $context_options['ssl']['verify_peer_name'] = false;
        }

        if ($this->request_options->has(RequestOptions::REQUEST_TIMEOUT)) {
            $context_options['http']['timeout'] = $this->request_options->get(RequestOptions::REQUEST_TIMEOUT);
        }

        if ($this->request_options->has(RequestOptions::USER_AGENT)) {
            $context_options['http']['user_agent'] = $this->request_options->get(RequestOptions::USER_AGENT);
        }

        $post_data = $this->preparePostData($request);

        if ($post_data !== null) {
            $context_options['http']['content'] = $post_data;
        }

        $request->setHeader('Accept', '*/*');

        if (!empty($request->getHeaders())) {
            $headers = '';

            foreach ($request->getHeaders() as $header_name => $header_value) {
                $headers .= $header_name . ': ' . $header_value . "\r\n";
            }

            $context_options['http']['header'] = $headers;
        }

        $request->setRequestTime(time());
        $response_headers = null;

        try {
            $context = $this->createResource(function () use ($context_options) {
                return stream_context_create($context_options);
            });
            $stream = $this->createResource(function () use ($url, $context, &$response_headers) {
                $resource = fopen($url, 'rb', false, $context);

                if (isset($http_response_header)) {
                    $response_headers = $http_response_header;
                }

                return $resource;
            });
        } catch (RuntimeException $e) {
            $message = $e->getMessage();

            if (
                strpos($message, 'getaddrinfo') !== false // DNS lookup failed
                || strpos($message, 'Connection refused') !== false
                || strpos($message, 'couldn\'t connect to host') !== false // error on HHVM
                || strpos($message, 'connection attempt failed') !== false
            ) {
                throw new ConnectException($e->getMessage(), $request, null, $e);
            }

            throw new RequestException($e->getMessage(), $request, 0, $e);
        }

        if ($response_headers === null) {
            throw new ConnectException(sprintf('Connection refused for URI %s', $url), $request);
        }

        $response_body = stream_get_contents($stream);

        fclose($stream);

        $response_time = time();
        $response_status_code = null;

        foreach ($response_headers as $response_header) {
            if (
                strpos($response_header, ':') === false
                && preg_match('/HTTP\/[0-9.]+\s+([0-9]+)/', $response_header, $match)
            ) {
                $response_status_code = intval($match[1]);

                break;
            }
        }

        $response_headers = self::parseHeaders($response_headers);

        return new Response($response_status_code, $response_headers, $response_body, $response_time);
    }

    /**
     * @param Request $request
     *
     * @return string
     */
    private function preparePostData(Request $request): ?string
    {
        $body = $request->getBody();

        if ($body === null) {
            return null;
        }

        if (
            isset($request->getHeaders()['Content-Type'])
            && preg_match('~^application/(?:json|vnd\.api\+json)~i', $request->getHeaders()['Content-Type'])
        ) {
            return json_encode($body);
        }

        if (is_array($body)) {
            return http_build_query($body);
        }

        return $body;
    }

    /**
     * @param callable $callback Callable that returns stream resource
     *
     * @return resource
     */
    private function createResource(callable $callback)
    {
        $errors = [];

        set_error_handler(static function ($_, $msg) use (&$errors): bool {
            $errors[] = $msg;

            return true;
        });

        try {
            $resource = $callback();
        } finally {
            restore_error_handler();
        }

        if (!$resource) {
            $message = 'Error creating resource: ';

            foreach ($errors as $error) {
                $message .= $error . PHP_EOL;
            }

            throw new RuntimeException(trim($message));
        }

        return $resource;
    }

    #region Helpers

    /**
     * Parses headers to array.
     *
     * @param array $headers_raw
     *
     * @return array
     * [
     *      'Server' => [ 'Apache' ],
     *      'Content-Type' => [ 'application/json' ],
     * ]
     */
    private static function parseHeaders(array $headers_raw): array
    {
        $headers = [];

        foreach ($headers_raw as $field) {
            if (!preg_match('/([^:]+): (.+)/m', $field, $match)) {
                continue;
            }

            // Convert: 'content-type' => 'Content-Type'.
            $header_name = preg_replace_callback(
                '/(?<=^|[\t -])./',
                fn ($matches) => strtoupper($matches[0]),
                strtolower(trim($match[1]))
            );

            if (!isset($headers[$header_name])) {
                $headers[$header_name] = [];
            }

            $headers[$header_name][] = trim($match[2]);
        }

        return $headers;
    }

    #endregion
}

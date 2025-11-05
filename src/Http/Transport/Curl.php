<?php

namespace Dreamscape\ResellerApiSdk\Http\Transport;

use Dreamscape\ResellerApiSdk\Exception\Http\ConnectException;
use Dreamscape\ResellerApiSdk\Exception\Http\RequestException;
use Dreamscape\ResellerApiSdk\Http\Request;
use Dreamscape\ResellerApiSdk\Http\RequestOptions;
use Dreamscape\ResellerApiSdk\Http\Response;

/**
 * Class for sending HTTP request and preparing HTTP response.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Curl extends AbstractTransport
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
        $ch = curl_init();
        $url = $this->base_uri . '/' . $request->getUri();

        if (!empty($request->getUrlParams())) {
            if (!strpos($url, '?') !== false) {
                $url .= '?';
            } else {
                $url .= '&';
            }

            $url .= http_build_query($request->getUrlParams());
        }

        $curl_options = [
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => $request->getMethod(),
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HEADER => 1,
        ];

        if ($this->request_options->has(RequestOptions::REQUEST_TIMEOUT)) {
            $curl_options += [
                CURLOPT_TIMEOUT => $this->request_options->get(RequestOptions::REQUEST_TIMEOUT),
            ];
        }

        if ($this->request_options->get(RequestOptions::VERIFY_SSL, true) === false) {
            $curl_options += [
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
            ];
        }

        if ($this->request_options->has(RequestOptions::USER_AGENT)) {
            $curl_options += [
                CURLOPT_USERAGENT => $this->request_options->get(RequestOptions::USER_AGENT),
            ];
        }

        $post_data = $this->preparePostData($request);

        if ($post_data !== null) {
            $curl_options[CURLOPT_POSTFIELDS] = $this->preparePostData($request);
        }

        if (!empty($request->getHeaders())) {
            $curl_headers = [];

            foreach ($request->getHeaders() as $header_name => $header_value) {
                $curl_headers[] = $header_name . ':' . $header_value;
            }

            $curl_options[CURLOPT_HTTPHEADER] = $curl_headers;
        }

        curl_setopt_array($ch, $curl_options);

        $request->setRequestTime(time());

        $response_body = curl_exec($ch);
        $response_time = time();

        if ($response_body === false) {
            [ $errno, $error ] = [ curl_errno($ch), curl_error($ch) ];

            curl_close($ch);

            $this->throwException($request, $errno, $error);
        }

        $response_header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $response_raw_header = substr($response_body, 0, $response_header_size);
        $response_headers = self::parseHeaders($response_raw_header);
        $response_body = substr($response_body, $response_header_size);
        $response_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

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
     * Throws an exception.
     * Is being using when the request executed with fail.
     *
     * @param Request $request
     * @param int $errno
     * @param string $error
     *
     * @throws ConnectException
     * @throws RequestException
     */
    private function throwException(Request $request, int $errno, string $error): void
    {
        static $connection_errors = [
            CURLE_OPERATION_TIMEOUTED => true,
            CURLE_COULDNT_RESOLVE_HOST => true,
            CURLE_COULDNT_CONNECT => true,
            CURLE_SSL_CONNECT_ERROR => true,
            CURLE_GOT_NOTHING => true,
        ];

        $message = sprintf('cURL error %s: %s', $errno, $error);

        throw isset($connection_errors[$errno])
            ? new ConnectException($message, $request, $errno)
            : new RequestException($message, $request, $errno);
    }

    #region Helpers

    /**
     * Parses headers to array.
     *
     * @param string $headers_string
     *
     * @return array
     * [
     *      'Server' => [ 'Apache' ],
     *      'Content-Type' => [ 'application/json' ],
     * ]
     */
    private static function parseHeaders(string $headers_string): array
    {
        $headers = [];
        $fields = explode("\r\n", preg_replace('/\r\n[\t ]+/', ' ', $headers_string));

        foreach ($fields as $field) {
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

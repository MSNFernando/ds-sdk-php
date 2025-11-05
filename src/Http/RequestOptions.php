<?php

namespace Dreamscape\ResellerApiSdk\Http;

use InvalidArgumentException;

/**
 * Options for HTTP request.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class RequestOptions
{
    public const VERIFY_SSL = 'verify_ssl';
    public const REQUEST_TIMEOUT = 'request_timeout';
    public const USER_AGENT = 'user_agent';

    private array $options = [];

    /**
     * Sets the value of option.
     *
     * @param string $name
     * @param mixed $value
     *
     * @return self
     */
    public function set(string $name, $value): self
    {
        if (empty($name)) {
            throw new InvalidArgumentException('The argument $name must be not empty string');
        }

        $this->options[$name] = $value;

        return $this;
    }

    /**
     * Checks does the value for option exist.
     *
     * @param string $name
     *
     * @return bool
     */
    public function has(string $name): bool
    {
        return array_key_exists($name, $this->options);
    }

    /**
     * Returns the value of option.
     *
     * @param string $name
     * @param mixed|null $default_value
     *
     * @return mixed|null
     */
    public function get(string $name, $default_value = null)
    {
        return $this->options[$name] ?? $default_value;
    }
}

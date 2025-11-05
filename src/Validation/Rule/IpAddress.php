<?php

namespace Dreamscape\ResellerApiSdk\Validation\Rule;

/**
 * Rule for checking the IP address.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class IpAddress extends AbstractRule
{
    public const TYPE_IPV4 = 'ipv4';
    public const TYPE_IPV6 = 'ipv6';
    public const TYPE_BOTH = 'both';

    /**
     * @inheritDoc
     */
    protected function areParametersValid(): bool
    {
        return count($this->parameters) === 1
            && is_string($this->parameters[0])
            && in_array($this->parameters[0], [ self::TYPE_IPV4, self::TYPE_IPV6, self::TYPE_BOTH ]);
    }

    /**
     * @inheritDoc
     */
    protected function getError(): string
    {
        if ($this->parameters[0] === self::TYPE_BOTH) {
            return 'The value must be a valid IPv4 or IPv6 address, or both, separated by comma.';
        }

        return sprintf(
            'The value must be a valid IPv%d address.',
            $this->parameters[0] === self::TYPE_IPV4 ? 4 : 6
        );
    }

    /**
     * @inheritDoc
     */
    protected function validate($value): bool
    {
        if ($value === null) {
            return true;
        }

        if (!is_string($value)) {
            return false;
        }

        if ($this->parameters[0] === self::TYPE_BOTH) {
            if (strpos($value, ',') === false) {
                return (bool) filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 & FILTER_FLAG_IPV6);
            }

            [ $ipv4, $ipv6 ] = explode(',', $value);

            return filter_var($ipv4, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)
                && filter_var($ipv6, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
        }

        return filter_var(
            $value,
            FILTER_VALIDATE_IP,
            $this->parameters[0] === self::TYPE_IPV4 ? FILTER_FLAG_IPV4 : FILTER_FLAG_IPV6
        );
    }
}

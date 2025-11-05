<?php

namespace Dreamscape\ResellerApiSdk\Validation\Rule;

/**
 * Rule for checking the phone number.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class PhoneNumber extends AbstractRule
{
    /**
     * @inheritDoc
     */
    protected function areParametersValid(): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    protected function getError(): string
    {
        return 'The value must be a valid phone number. ' .
            'Accept: 12345678912, +(123)123456789, +123-456-7890, +123 123 456789';
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

        $value = trim($value);

        if (strpos($value, '+') === 0) {
            $value = substr($value, 1);
        }

        $length = strlen(preg_replace('/[^0-9]+/', '', $value));

        return $length >= 8 && $length <= 15;
    }
}

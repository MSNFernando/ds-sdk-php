<?php

namespace Dreamscape\ResellerApiSdk\Validation\Rule;

/**
 * Rule for checking the Email.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Email extends AbstractRule
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
        return 'The value must be a valid email address.';
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

        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }
}

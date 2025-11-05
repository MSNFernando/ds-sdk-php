<?php

namespace Dreamscape\ResellerApiSdk\Validation\Rule;

/**
 * Rule for requiring the value.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Required extends AbstractRule
{
    /**
     * @inheritDoc
     */
    protected function areParametersValid(): bool
    {
        return count($this->parameters) === 0;
    }

    /**
     * @inheritDoc
     */
    protected function getError(): string
    {
        return 'The value is required';
    }

    /**
     * @inheritDoc
     */
    protected function validate($value): bool
    {
        return $value !== null;
    }
}

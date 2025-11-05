<?php

namespace Dreamscape\ResellerApiSdk\Validation\Rule;

/**
 * Rule for checking for the allowed values.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class AllowedValues extends AbstractRule
{
    /**
     * @inheritDoc
     */
    protected function areParametersValid(): bool
    {
        return count($this->parameters) === 1
            && is_array($this->parameters[0])
            && !empty($this->parameters[0]);
    }

    /**
     * @inheritDoc
     */
    protected function getError(): string
    {
        return 'Only the next values are allowed: ' . implode(', ', $this->parameters[0]);
    }

    /**
     * @inheritDoc
     */
    protected function validate($value): bool
    {
        return $value === null || in_array($value, $this->parameters[0]);
    }
}

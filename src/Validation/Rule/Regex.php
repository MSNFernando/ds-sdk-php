<?php

namespace Dreamscape\ResellerApiSdk\Validation\Rule;

/**
 * Rule for checking the regex.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Regex extends AbstractRule
{
    /**
     * @inheritDoc
     */
    protected function areParametersValid(): bool
    {
        return count($this->parameters) === 1 && is_string($this->parameters[0]);
    }

    /**
     * @inheritDoc
     */
    protected function getError(): string
    {
        return 'The value should match the regular expression: ' . $this->parameters[0];
    }

    /**
     * @inheritDoc
     */
    protected function validate($value): bool
    {
        if ($value === null) {
            return true;
        }

        return preg_match($this->parameters[0], $value);
    }
}

<?php

namespace Dreamscape\ResellerApiSdk\Validation\Rule;

/**
 * Rule for checking the number is less or equal than.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class NumberLessEqual extends AbstractRule
{
    /**
     * @inheritDoc
     */
    protected function areParametersValid(): bool
    {
        return count($this->parameters) === 1 && is_integer($this->parameters[0]);
    }

    /**
     * @inheritDoc
     */
    protected function getError(): string
    {
        return sprintf('The value should be less than or equal to %s', $this->parameters[0]);
    }

    /**
     * @inheritDoc
     */
    protected function validate($value): bool
    {
        if ($value === null) {
            return true;
        }

        return $value <= $this->parameters[0];
    }
}

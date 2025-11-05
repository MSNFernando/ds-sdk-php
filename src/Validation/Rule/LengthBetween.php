<?php

namespace Dreamscape\ResellerApiSdk\Validation\Rule;

/**
 * Rule for checking the min and max length.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class LengthBetween extends AbstractRule
{
    /**
     * @inheritDoc
     */
    protected function areParametersValid(): bool
    {
        return count($this->parameters) === 2 &&
            is_int($this->parameters[0]) &&
            is_int($this->parameters[1]) &&
            $this->parameters[0] <= $this->parameters[1];
    }

    /**
     * @inheritDoc
     */
    protected function getError(): string
    {
        return 'The length should be greater than or equal to ' . $this->parameters[0] .
            ' and less or equal to ' . $this->parameters[1];
    }

    /**
     * @inheritDoc
     */
    protected function validate($value): bool
    {
        if ($value === null) {
            return true;
        }

        $length = mb_strlen((string) $value);
        return $this->parameters[0] <= $length && $length <= $this->parameters[1];
    }
}

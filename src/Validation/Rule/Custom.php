<?php

namespace Dreamscape\ResellerApiSdk\Validation\Rule;

use Closure;

/**
 * Rule for checking using the callback.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Custom extends AbstractRule
{
    /**
     * @inheritDoc
     */
    public static function allowMultiple(): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    protected function areParametersValid(): bool
    {
        return count($this->parameters) === 1 && is_callable($this->parameters[0]);
    }

    /**
     * @inheritDoc
     */
    protected function getError(): string
    {
        return 'Invalid value';
    }

    /**
     * @inheritDoc
     */
    protected function validate($value): bool
    {
        if ($value === null) {
            return true;
        }

        return Closure::fromCallable($this->parameters[0])
            ->call($this, $value);
    }
}

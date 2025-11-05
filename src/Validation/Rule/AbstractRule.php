<?php

namespace Dreamscape\ResellerApiSdk\Validation\Rule;

use InvalidArgumentException;
use LogicException;

/**
 * Base class for the validation rules.
 *
 * @property-read array $parameters
 * @property-read string|null $validationError
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
abstract class AbstractRule
{
    private array $parameters;
    private string $error;
    private ?string $validation_error = null;

    /**
     * Constructor.
     *
     * @param array $parameters
     */
    private function __construct(array $parameters)
    {
        $this->parameters = $parameters;

        if (!$this->areParametersValid()) {
            throw new LogicException('The provided parameters do not meet the requirements');
        }

        $this->error = $this->getError();
    }

    /**
     * Returns the new instance of rule.
     *
     * @return static
     */
    public static function build(array $parameters): self
    {
        return new static($parameters);
    }

    /**
     * @param string $name
     *
     * @return array|string
     */
    public function __get(string $name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException('The argument $name must be not empty string');
        }

        switch ($name) {
            case 'parameters':
                return $this->parameters;

            case 'validationError':
                return $this->validation_error;
        }

        throw new InvalidArgumentException('The property \'' . $name . '\' does not exist');
    }

    /**
     * Sets the default validation error.
     *
     * @param string $error
     *
     * @return static
     */
    public function error(string $error): self
    {
        $this->error = $error;

        return $this;
    }

    /**
     * Sets the current validation error message.
     *
     * @param string $validation_error
     *
     * @return static
     */
    protected function validationError(string $validation_error): self
    {
        $this->validation_error = $validation_error;

        return $this;
    }

    /**
     * Checks is the provided value valid according to the logic of rule.
     * In case if value is invalid, the error will be saved to the `validationError` property.
     *
     * @param mixed $value
     *
     * @return bool
     */
    public function isValid($value): bool
    {
        $this->validation_error = null;
        $is_valid = $this->validate($value);

        if (!$is_valid && empty($this->validation_error)) {
            $this->validation_error = $this->error;
        }

        return $is_valid;
    }

    /**
     * @return bool
     *
     * @codeCoverageIgnore
     */
    public static function allowMultiple(): bool
    {
        return false;
    }

    /**
     * Checks do the provided parameters meet the requirements.
     *
     * @return bool
     */
    abstract protected function areParametersValid(): bool;

    /**
     * Return the default error message for the rule.
     *
     * @return string
     */
    abstract protected function getError(): string;

    /**
     * Performs the validation process.
     *
     * @param mixed $value
     *
     * @return bool
     */
    abstract protected function validate($value): bool;
}

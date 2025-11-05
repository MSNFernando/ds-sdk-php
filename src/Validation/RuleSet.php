<?php

namespace Dreamscape\ResellerApiSdk\Validation;

use Dreamscape\ResellerApiSdk\Validation\Rule\AbstractRule;
use InvalidArgumentException;
use LogicException;

/**
 * Set of validation rules.
 *
 * @property-read string|null $validationError
 * @property-read AbstractRule|null $validationErrorRule
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class RuleSet
{
    /** @var Rule\AbstractRule[] */
    private array $rules = [];
    private array $rules_types = [];
    private ?string $validation_error = null;
    private ?AbstractRule $validation_error_rule = null;
    private bool $is_compiled = false;

    /**
     * Marked as `private` to force use `build()` method.
     */
    private function __construct()
    {
    }

    /**
     * Returns the new instance of rule set.
     *
     * @return self
     */
    public static function build(): self
    {
        return new self();
    }

    /**
     * @param string $name
     *
     * @return string|AbstractRule
     */
    public function __get(string $name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException('The argument $name must be not empty string');
        }

        if ($name == 'validationError') {
            return $this->validation_error;
        }

        if ($name == 'validationErrorRule') {
            return $this->validation_error_rule;
        }

        throw new InvalidArgumentException('The property \'' . $name . '\' does not exist');
    }

    /**
     * Adds the rule to set.
     *
     * @param Rule\AbstractRule $rule
     *
     * @return self
     */
    public function addRule(Rule\AbstractRule $rule): self
    {
        if ($this->is_compiled) {
            throw new LogicException('This set of rules is compiled already!');
        }

        $rule_type = get_class($rule);

        if (!$rule::allowMultiple() && in_array($rule_type, $this->rules_types)) {
            throw new LogicException(
                'The only one rule of type \'' . $rule_type . '\' can be added'
            );
        }

        $this->rules[] = $rule;
        end($this->rules);
        $this->rules_types[key($this->rules)] = get_class($rule);

        return $this;
    }

    /**
     * Removed the rule from the set with the specified type.
     *
     * @param string $rule_type
     *
     * @return self
     */
    public function removeRulesByType(string $rule_type): self
    {
        if (empty($rule_type)) {
            throw new InvalidArgumentException('The argument $rule_type must be not empty string');
        }

        if ($this->is_compiled) {
            throw new LogicException('This set of rules is compiled already!');
        }

        foreach ($this->rules_types as $key => $existing_rules_type) {
            if ($existing_rules_type === $rule_type) {
                unset($this->rules[$key]);
                unset($this->rules_types[$key]);
            }
        }

        return $this;
    }

    /**
     * Checks is the provided value valid according to the logic of rules.
     * In case if value is invalid, the error will be saved to the `validationError` property.
     *
     * @param mixed $value
     *
     * @return bool
     */
    public function isValid($value): bool
    {
        $this->validation_error = null;

        foreach ($this->rules as $rule) {
            if (!$rule->isValid($value)) {
                $this->validation_error = $rule->validationError;
                $this->validation_error_rule = $rule;

                return false;
            }
        }

        return true;
    }

    /**
     * Compiles the rule set to prevent the changes in runtime.
     *
     * @return self
     */
    public function compile(): self
    {
        $this->is_compiled = true;
        // no need in this anymore
        unset($this->rules_types);

        return $this;
    }
}

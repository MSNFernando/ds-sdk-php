<?php

namespace Dreamscape\ResellerApiSdk\Validation;

/**
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Error
{
    protected string $data_object_class;
    protected string $field;
    protected string $message;
    protected string $rule_class;
    protected array $rule_parameters;

    /**
     * @param string $data_object_class
     * @param string $field
     * @param string $message
     * @param string $rule_class
     * @param array $rule_parameters
     */
    public function __construct(
        string $data_object_class,
        string $field,
        string $message,
        string $rule_class,
        array $rule_parameters
    ) {
        $this->data_object_class = $data_object_class;
        $this->field = $field;
        $this->message = $message;
        $this->rule_class = $rule_class;
        $this->rule_parameters = $rule_parameters;
    }

    /**
     * @return string
     */
    public function getDataObjectClass(): string
    {
        return $this->data_object_class;
    }

    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getRuleClass(): string
    {
        return $this->rule_class;
    }

    /**
     * @return array
     */
    public function getRuleParameters(): array
    {
        return $this->rule_parameters;
    }
}

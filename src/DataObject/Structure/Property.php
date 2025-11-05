<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Structure;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;
use InvalidArgumentException;
use LogicException;

/**
 * The class for defining the specification of data-object property.
 *
 * @property-read string $name
 * @property-read string $field
 * @property-read string $type
 * @property-read string|AbstractDataObject|null $collectionType
 * @property-read string|AbstractDataObject|null $dataObjectType
 * @property-read RuleSet|null $rules
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
final class Property
{
    private string $name;
    private string $field;
    private ?string $type = null;
    private ?string $collection_class = null;
    private ?string $data_object_class = null;
    private bool $is_compiled = false;
    private ?RuleSet $rules = null;

    /**
     * Constructor.
     *
     * @param string $name
     * @param string|null $field
     */
    private function __construct(string $name, string $field = null)
    {
        if (empty($name)) {
            throw new InvalidArgumentException('The argument $name must be not empty string');
        }

        if ($field !== null && empty($field)) {
            throw new InvalidArgumentException('The argument $field must be not empty string');
        }

        $this->name = $name;
        $this->field = $field ?: $name;
    }

    /**
     * Creates the instance of property.
     *
     * @param string $name
     * @param string|null $field
     *
     * @return self
     */
    public static function build(string $name, string $field = null): self
    {
        return new self($name, $field);
    }

    /**
     * @param string $name
     *
     * @return string|null|RuleSet
     */
    public function __get(string $name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException('The argument $name must be not empty string');
        }

        switch ($name) {
            case 'name':
                return $this->name;

            case 'field':
                return $this->field;

            case 'type':
                return $this->type;

            case 'collectionType':
                return $this->collection_class;

            case 'dataObjectType':
                return $this->data_object_class;

            case 'rules':
                return $this->rules;
        }

        throw new InvalidArgumentException('The property \'' . $name . '\' does not exist');
    }

    /**
     * @param string $type
     *
     * @return self
     */
    public function type(string $type): self
    {
        if (empty($type)) {
            throw new InvalidArgumentException('The argument $type must be not empty string');
        }

        if ($this->is_compiled) {
            throw new LogicException('This property is compiled already!');
        }

        if ($this->type || $this->data_object_class || $this->collection_class) {
            throw new InvalidArgumentException('The type already specified for the property');
        }

        if (!DataType::isValid($type)) {
            throw new InvalidArgumentException('The data-type is invalid');
        }

        $this->type = $type;

        return $this;
    }

    /**
     * @param string $data_object_class
     *
     * @return self
     */
    public function collectionType(string $data_object_class): self
    {
        if (empty($data_object_class)) {
            throw new InvalidArgumentException('The argument $data_object_class must be not empty string');
        }

        if ($this->is_compiled) {
            throw new LogicException('This property is compiled already!');
        }

        if ($this->type || $this->data_object_class || $this->collection_class) {
            throw new InvalidArgumentException('The type already specified for the property');
        }

        if (
            !DataType::isValid($data_object_class)
            && !in_array(AbstractDataObject::class, class_parents($data_object_class))
        ) {
            throw new InvalidArgumentException(
                'The class \'' . $data_object_class . '\' must be heir of \'' . AbstractDataObject::class . '\''
            );
        }

        $this->collection_class = $data_object_class;

        return $this;
    }

    /**
     * @param string $data_object_class
     *
     * @return self
     */
    public function dataObjectType(string $data_object_class): self
    {
        if (empty($data_object_class)) {
            throw new InvalidArgumentException('The argument $data_object_class must be not empty string');
        }

        if ($this->is_compiled) {
            throw new LogicException('This property is compiled already!');
        }

        if ($this->type || $this->data_object_class || $this->collection_class) {
            throw new InvalidArgumentException('The type already specified for the property');
        }

        if (!in_array(AbstractDataObject::class, class_parents($data_object_class))) {
            throw new InvalidArgumentException(
                'The class \'' . $data_object_class . '\' must be heir of \'' . AbstractDataObject::class . '\''
            );
        }

        $this->data_object_class = $data_object_class;

        return $this;
    }

    /**
     * @param RuleSet $rules
     *
     * @return self
     */
    public function rules(RuleSet $rules): self
    {
        if ($this->is_compiled) {
            throw new LogicException('This property is compiled already!');
        }

        $this->rules = $rules;

        return $this;
    }

    /**
     * Compiles the property to prevent the changes in runtime.
     *
     * @return self
     */
    public function compile(): self
    {
        if (!$this->type && !$this->collection_class && !$this->data_object_class) {
            throw new LogicException('The type is not specified for the \'' . $this->name . '\' property');
        }

        if (!$this->type && $this->rules) {
            throw new LogicException(
                'Validation rules cannot be specified for the property ' .
                '\'' . $this->name . '\' because the complex type is used for this'
            );
        }

        $this->rules && $this->rules->compile();
        $this->is_compiled = true;

        return $this;
    }
}

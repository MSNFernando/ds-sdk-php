<?php

namespace Dreamscape\ResellerApiSdk\DataObject;

use BadMethodCallException;
use Dreamscape\ResellerApiSdk\DataObject\Structure\DataType;
use Dreamscape\ResellerApiSdk\DataObject\Structure\Property;
use Dreamscape\ResellerApiSdk\Exception\ValidationException;
use Dreamscape\ResellerApiSdk\Validation\Error;
use InvalidArgumentException;

/**
 * Base class for the data-objects.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
abstract class AbstractDataObject
{
    /**
     * The list of defined structures for data-object.
     *
     * @var Structure[]
     */
    protected static array $defined_structures = [];

    /**
     * Values of properties.
     *
     * @var array
     */
    private array $properties_values = [];

    /**
     * Marked as `private` to force use `build()` method.
     *
     * @param array $properties_values
     */
    private function __construct(array $properties_values = [])
    {
        foreach ($properties_values as $property => $value) {
            $this->{'set' . $property}($value);
        }
    }

    /**
     * @return Structure
     */
    final public static function getStructure(): Structure
    {
        if (!isset(static::$defined_structures[static::class])) {
            static::$defined_structures[static::class] = static::describeStructure()
                ->compile();
        }

        return static::$defined_structures[static::class];
    }

    /**
     * Magic method __call(). Currently, is used to handle setters.
     *
     * @param string $method_name
     * @param array $arguments
     *
     * @return self
     */
    public function __call(string $method_name, array $arguments)
    {
        if (empty($method_name)) {
            throw new InvalidArgumentException('The property $method_name must be not empty string');
        }

        if (strpos($method_name, 'set') !== 0) {
            throw new BadMethodCallException('The method ' . $method_name . ' does not exist');
        }

        if (count($arguments) === 0) {
            throw new InvalidArgumentException('The value of property is not specified');
        }

        $property_name = substr($method_name, 3);

        if (isset($property_name[0])) {
            $property_name[0] = strtolower($property_name[0]);
        }

        return $this->setPropertyValue($property_name, $arguments[0]);
    }

    /**
     * Returns the value of property.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function __get(string $name)
    {
        return $this->getPropertyValue($name);
    }

    /**
     * Sets the value of property.
     *
     * @param string $name
     * @param mixed $value
     */
    public function __set(string $name, $value)
    {
        $this->{'set' . $name}($value);
    }

    /**
     * Checks the existence of value for property.
     *
     * @param string $name
     *
     * @return bool
     */
    public function __isset(string $name)
    {
        return static::getStructure()->propertyExists($name)
            && isset($this->properties_values[$name]);
    }

    /**
     * Removes the value of property.
     *
     * @param string $property
     */
    public function __unset(string $property)
    {
        if (empty($property)) {
            throw new InvalidArgumentException('The argument $property must be not empty string');
        }

        unset($this->properties_values[$property]);
    }

    /**
     * Sets the value of property.
     *
     * @param string $property_name
     * @param mixed $value
     *
     * @return self
     * @throws ValidationException
     */
    final protected function setPropertyValue(string $property_name, $value): self
    {
        if (empty($property_name)) {
            throw new InvalidArgumentException('The argument $property_name must be not empty string');
        }

        if (!static::getStructure()->propertyExists($property_name)) {
            throw new InvalidArgumentException('The property \'' . $property_name . '\' does not exist');
        }

        $property = self::getStructure()->getProperty($property_name);

        self::ensurePropertyValueApplicable($property, $value);

        if ($property->type) {
            $value = DataType::convert($property->type, $value);
        } elseif ($property->dataObjectType && is_array($value)) {
            $value = $property->dataObjectType::build($value);
        } elseif ($property->collectionType && is_array($value)) {
            $value = Collection::build($property->collectionType)->import($value);
        }

        if ($property->rules !== null && !$property->rules->isValid($value)) {
            throw new ValidationException([
                new Error(
                    static::class,
                    $property->name,
                    $property->rules->validationError,
                    get_class($property->rules->validationErrorRule),
                    $property->rules->validationErrorRule->parameters
                ),
            ]);
        }

        $this->properties_values[$property_name] = $value;

        return $this;
    }

    /**
     * Returns the value of property.
     *
     * @param string $property_name
     *
     * @return mixed
     */
    private function getPropertyValue(string $property_name)
    {
        if (empty($property_name)) {
            throw new InvalidArgumentException('The argument $property must be not empty string');
        }

        if (!static::getStructure()->propertyExists($property_name)) {
            throw new InvalidArgumentException('The property ' . $property_name . ' does not exist');
        }

        if (!isset($this->properties_values[$property_name])) {
            $property = static::getStructure()->getProperty($property_name);

            if ($property->collectionType) {
                $this->properties_values[$property_name] = Collection::build($property->collectionType);
            } elseif ($property->dataObjectType) {
                $this->properties_values[$property_name] = $property->dataObjectType::build();
            }
        }

        return $this->properties_values[$property_name] ?? null;
    }

    /**
     * @return static
     * @throws ValidationException
     */
    public function validate(): self
    {
        $validationErrors = [];

        foreach (self::getStructure()->getProperties() as $property) {
            $value = $this->properties_values[$property->name] ?? null;

            if ($property->type) {
                if ($property->rules === null) {
                    continue;
                }

                if (!$property->rules->isValid($value)) {
                    $validationErrors[] = new Error(
                        static::class,
                        $property->name,
                        $property->rules->validationError,
                        get_class($property->rules->validationErrorRule),
                        $property->rules->validationErrorRule->parameters
                    );

                    continue;
                }

                continue;
            }

            if ($property->dataObjectType && $value) {
                /** @var self $value */
                $value->validate();

                continue;
            }

            if ($property->collectionType && $value) {
                foreach ($value as $item) {
                    /** @var self $item */
                    $item->validate();
                }
            }
        }

        if (!empty($validationErrors)) {
            throw new ValidationException($validationErrors);
        }

        return $this;
    }

    /**
     * Returns the associative array where key is the field of property
     * and value is the value of property.
     *
     * @return array
     */
    public function toRequestArray(): array
    {
        $this->validate();

        $data = [];

        foreach (static::getStructure()->getProperties() as $property_name => $property) {
            if (!isset($this->properties_values[$property_name])) {
                continue;
            }

            if ($property->dataObjectType || $property->collectionType) {
                $data[$property->field] = $this->properties_values[$property_name]->toRequestArray();

                continue;
            } elseif ($property->type && $property->type === DataType::DATETIME) {
                $data[$property->field] = $this->properties_values[$property_name]->format('Y-m-d');

                continue;
            }

            $data[$property->field] = $this->properties_values[$property_name];
        }

        return $data;
    }

    /**
     * Returns the associative array where key is the name of property
     * and value is the value of property.
     *
     * @return array
     */
    public function toArray(): array
    {
        $data = [];

        foreach (static::getStructure()->getProperties() as $property_name => $property) {
            if (!isset($this->properties_values[$property_name])) {
                $data[$property_name] = null;

                continue;
            }

            if ($property->dataObjectType || $property->collectionType) {
                $data[$property_name] = $this->properties_values[$property_name]->toArray();

                continue;
            }

            $data[$property_name] = $this->properties_values[$property_name];
        }

        return $data;
    }

    /**
     * Returns the new instance of entity from array.
     *
     * @return static
     */
    public static function build(array $properties_values = []): self
    {
        if (empty($properties_values)) {
            return new static();
        }

        $values = [];

        foreach (static::getStructure()->getProperties() as $property) {
            if (!isset($properties_values[$property->name])) {
                continue;
            }

            $values[$property->name] = $properties_values[$property->name];
        }

        return new static($values);
    }

    /**
     * @param Property $property
     * @param mixed $value
     *
     * @throws InvalidArgumentException - if value is not applicable
     */
    final protected static function ensurePropertyValueApplicable(Property $property, $value)
    {
        if ($property->collectionType) {
            if ((!$value instanceof Collection || $value->type !== $property->collectionType) && !is_array($value)) {
                throw new InvalidArgumentException(
                    'The value of property \'' . $property->name . '\' ' .
                    'must be the collection of the instances of the \'' . $property->collectionType . '\' class'
                );
            }

            return;
        }

        if ($property->dataObjectType) {
            if (!$value instanceof $property->dataObjectType && !is_array($value)) {
                throw new InvalidArgumentException(
                    'The value of property \'' . $property->name . '\' must be ' .
                    'the instance of the  \'' . $property->dataObjectType . '\' class'
                );
            }

            return;
        }

        if ($property->type && !DataType::isValueApplicable($property->type, $value)) {
            throw new InvalidArgumentException(
                'The value of property \'' . $property->name . '\' is not applicable'
            );
        }
    }

    /**
     * The list of entity's properties. The key is the name of property
     * and the value is the name of key in array returned by `entity()` method.
     *
     * @return Structure
     */
    abstract protected static function describeStructure(): Structure;
}

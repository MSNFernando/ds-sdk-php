<?php

namespace Dreamscape\ResellerApiSdk\DataObject;

use Dreamscape\ResellerApiSdk\DataObject\Structure\Property;
use InvalidArgumentException;
use LogicException;

/**
 * The class for defining the specification of data-object structure.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
final class Structure
{
    /** @var Property[] */
    private array $properties = [];
    private bool $is_compiled = false;

    /**
     * @return self
     */
    public static function build(): self
    {
        return new self();
    }

    /**
     * @param Property $property
     *
     * @return self
     */
    public function addProperty(Property $property): self
    {
        if ($this->is_compiled) {
            throw new LogicException('This structure is compiled already!');
        }

        if (isset($this->properties[$property->name])) {
            throw new InvalidArgumentException('The property with name \'' . $property->name . '\' already added');
        }

        $this->properties[$property->name] = $property;

        return $this;
    }

    /**
     * @param string $property_name
     *
     * @return self
     */
    public function removeProperty(string $property_name): self
    {
        if ($this->is_compiled) {
            throw new LogicException('This structure is compiled already!');
        }

        if (!isset($this->properties[$property_name])) {
            throw new InvalidArgumentException('The property with name \'' . $property_name . '\' does not exist');
        }

        unset($this->properties[$property_name]);

        return $this;
    }

    /**
     * @param string $property_name
     *
     * @return Property
     */
    public function getProperty(string $property_name): Property
    {
        if (empty($property_name)) {
            throw new InvalidArgumentException('The argument $property_name must be not empty string');
        }

        if (!isset($this->properties[$property_name])) {
            throw new InvalidArgumentException('The property \'' . $property_name . '\' does not exist');
        }

        return $this->properties[$property_name];
    }

    /**
     * @param string $property_name
     *
     * @return bool
     */
    public function propertyExists(string $property_name): bool
    {
        if (empty($property_name)) {
            throw new InvalidArgumentException('The argument $property_name must be not empty string');
        }

        return isset($this->properties[$property_name]);
    }

    /**
     * @return Property[]
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * Compiles the structure to prevent the changes in runtime.
     *
     * @return self
     */
    public function compile(): self
    {
        foreach ($this->properties as $property) {
            $property->compile();
        }

        $this->is_compiled = true;

        return $this;
    }
}

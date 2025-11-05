<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Domain\DNS\Existing;

use BadMethodCallException;
use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\PredefinedValue;
use InvalidArgumentException;

/**
 * This is abstract data-object for the existing DNS record.
 * See concrete implementation of data-object for each type of DNS record.
 *
 * @property-read int $id
 * @property-read string $type
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
abstract class AbstractRecord extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(Structure\Property::build('id')
                ->type(Structure\DataType::INTEGER))
            ->addProperty(Structure\Property::build('type')
                ->type(Structure\DataType::STRING));
    }

    /**
     * @inheritDoc
     */
    public static function build(array $properties_values = []): self
    {
        $properties_values['type'] = static::defineRecordType();

        return parent::build($properties_values);
    }

    /**
     * Do not allow changing of the id.
     *
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id): self
    {
        if ($this->id) {
            throw new BadMethodCallException('The changing of record ID is not allowed');
        }

        return $this->setPropertyValue('id', $id);
    }

    /**
     * Do not allow changing of the type.
     *
     * @param string $type
     *
     * @return self
     */
    public function setType(string $type): self
    {
        if ($this->type) {
            throw new BadMethodCallException('The changing of record type is not allowed');
        }

        return $this->setPropertyValue('type', $type);
    }

    /**
     * @param string $type
     *
     * @return string
     */
    final public static function getRecordClassByType(string $type): string
    {
        if (empty($type)) {
            throw new InvalidArgumentException('The argument $type must be not empty string');
        }

        $type = strtoupper($type);

        switch ($type) {
            case PredefinedValue\Domain\DNS::A:
            case PredefinedValue\Domain\DNS::AAAA:
            case PredefinedValue\Domain\DNS::CAA:
            case PredefinedValue\Domain\DNS::CNAME:
            case PredefinedValue\Domain\DNS::MAILFWD:
            case PredefinedValue\Domain\DNS::MX:
            case PredefinedValue\Domain\DNS::SRV:
            case PredefinedValue\Domain\DNS::TXT:
            case PredefinedValue\Domain\DNS::WEBFWD:
                break;

            default:
                throw new InvalidArgumentException('The type \'' . $type . '\' is invalid');
        }

        return __NAMESPACE__ . '\\' . strtoupper($type);
    }

    /**
     * @return string
     */
    abstract protected static function defineRecordType(): string;
}

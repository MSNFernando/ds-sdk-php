<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Domain\DNS;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;

/**
 * This is abstract data-object for the creating/updating the DNS record.
 * See concrete implementation of data-object for each type of DNS record.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
abstract class AbstractCreateUpdate extends AbstractDataObject
{
    private string $type;

    /**
     * @inheritDoc
     */
    public static function build(array $properties_values = []): self
    {
        $object = parent::build($properties_values);
        $object->type = static::defineRecordType();

        return $object;
    }

    /**
     * @inheritDoc
     */
    public function toRequestArray(): array
    {
        $data = parent::toRequestArray();
        $data['type'] = $this->type;

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        $data = parent::toArray();
        $data['type'] = $this->type;

        return $data;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    abstract protected static function defineRecordType(): string;
}

<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Domain\DNS\Existing;

use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\Property;
use Dreamscape\ResellerApiSdk\PredefinedValue;

/**
 * @property string $value
 * @property int $flag
 * @property string $tag
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class CAA extends AbstractRecord
{
    /**
     * @inheritDoc
     */
    protected static function defineRecordType(): string
    {
        return PredefinedValue\Domain\DNS::CAA;
    }

    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return parent::describeStructure()
            ->addProperty(Property::build('value')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('flag')
                ->type(Structure\DataType::INTEGER))
            ->addProperty(Property::build('tag')
                ->type(Structure\DataType::STRING));
    }
}

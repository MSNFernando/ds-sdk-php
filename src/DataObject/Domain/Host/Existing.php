<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Domain\Host;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\Property;

/**
 * @property string $host
 * @property string $ip
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Existing extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(Property::build('host')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('ip')
                ->type(Structure\DataType::STRING));
    }
}

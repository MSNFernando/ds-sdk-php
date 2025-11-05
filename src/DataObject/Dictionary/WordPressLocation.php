<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Dictionary;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\Property;

/**
 * @property string $code
 * @property string $name
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class WordPressLocation extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(Property::build('code')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('name')
                ->type(Structure\DataType::STRING));
    }
}

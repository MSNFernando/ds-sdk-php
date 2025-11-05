<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\Base\LoginLink;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\Property;

/**
 * @property string $link
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
abstract class AbstractExisting extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(Property::build('link')
                ->type(Structure\DataType::STRING))
            ;
    }
}

<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Finance;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;

/**
 * @property string $code
 * @property string $name
 * @property string $symbol
 * @property string $alternativeSymbol
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Currency extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(Structure\Property::build('code')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('name')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('symbol')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('alternativeSymbol', 'alternative_symbol')
                ->type(Structure\DataType::STRING));
    }
}

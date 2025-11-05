<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Finance;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;

/**
 * @property float $balance
 * @property string $currency
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Balance extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(Structure\Property::build('balance')
                ->type(Structure\DataType::FLOAT))
            ->addProperty(Structure\Property::build('currency')
                ->type(Structure\DataType::STRING));
    }
}

<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Finance;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;

/**
 * @property string $type
 * @property int $productId
 * @property string $productName
 * @property float $price
 * @property string $description
 * @property int $period
 * @property float $discount
 * @property float $tax
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class InvoiceOrder extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(Structure\Property::build('type')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('productId', 'product_id')
                ->type(Structure\DataType::INTEGER))
            ->addProperty(Structure\Property::build('productName', 'product_name')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('price')
                ->type(Structure\DataType::FLOAT))
            ->addProperty(Structure\Property::build('description')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('period')
                ->type(Structure\DataType::INTEGER))
            ->addProperty(Structure\Property::build('discount')
                ->type(Structure\DataType::FLOAT))
            ->addProperty(Structure\Property::build('tax')
                ->type(Structure\DataType::FLOAT));
    }
}

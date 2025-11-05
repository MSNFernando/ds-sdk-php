<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Finance;

use DateTime;
use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Collection;
use Dreamscape\ResellerApiSdk\DataObject\Structure;

/**
 * @property int $id
 * @property int $customerId
 * @property float $totalAmount
 * @property float $tax
 * @property string $currency
 * @property bool $isPaid
 * @property DateTime $orderDate
 * @property Collection|InvoiceOrder[] $orders
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Invoice extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(Structure\Property::build('id')
                ->type(Structure\DataType::INTEGER))
            ->addProperty(Structure\Property::build('customerId', 'customer_id')
                ->type(Structure\DataType::INTEGER))
            ->addProperty(Structure\Property::build('totalAmount', 'total_amount')
                ->type(Structure\DataType::FLOAT))
            ->addProperty(Structure\Property::build('discount')
                ->type(Structure\DataType::FLOAT))
            ->addProperty(Structure\Property::build('tax')
                ->type(Structure\DataType::FLOAT))
            ->addProperty(Structure\Property::build('currency')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('isPaid', 'is_paid')
                ->type(Structure\DataType::BOOL))
            ->addProperty(Structure\Property::build('orderDate', 'order_date')
                ->type(Structure\DataType::DATETIME))
            ->addProperty(Structure\Property::build('orders')
                ->collectionType(InvoiceOrder::class));
    }
}

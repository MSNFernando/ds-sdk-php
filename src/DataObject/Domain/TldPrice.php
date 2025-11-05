<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Domain;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;

/**
 * @property float $register
 * @property float $renew
 * @property float $transfer
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class TldPrice extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(Structure\Property::build('register')
                ->type(Structure\DataType::FLOAT))
            ->addProperty(Structure\Property::build('renew')
                ->type(Structure\DataType::FLOAT))
            ->addProperty(Structure\Property::build('transfer')
                ->type(Structure\DataType::FLOAT));
    }
}

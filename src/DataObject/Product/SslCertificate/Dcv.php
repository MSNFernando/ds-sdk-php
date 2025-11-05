<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\SslCertificate;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;

/**
 * @property string $method
 * @property string[] $availableMethods
 *
 * @method $this setMethod(string $method)
 * @method $this setAvailableMethods(string[] $availableMethods)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Dcv extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(
                Structure\Property::build('method')
                    ->type(Structure\DataType::STRING)
            )
            ->addProperty(
                Structure\Property::build('availableMethods', 'available_methods')
                    ->type(Structure\DataType::STRING_ARRAY)
            )
            ;
    }
}

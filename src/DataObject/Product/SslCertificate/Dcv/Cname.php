<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\SslCertificate\Dcv;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;

/**
 * @property string $name
 * @property string $value
 *
 * @method $this setName(string $name)
 * @method $this setValue(string $value)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Cname extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(
                Structure\Property::build('name')
                    ->type(Structure\DataType::STRING)
            )
            ->addProperty(
                Structure\Property::build('value')
                    ->type(Structure\DataType::STRING)
            )
            ;
    }
}

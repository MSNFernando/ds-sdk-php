<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Domain;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;

/**
 * @property string $domainName
 * @property bool|null $isAvailable
 * @property string|null $status
 * @property float|null $registerPrice
 * @property float|null $renewPrice
 * @property string|null $checkingError
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class AvailabilityResult extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(Structure\Property::build('domainName', 'domain_name')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('isAvailable', 'is_available')
                ->type(Structure\DataType::BOOL))
            ->addProperty(Structure\Property::build('status')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('registerPrice', 'register_price')
                ->type(Structure\DataType::FLOAT))
            ->addProperty(Structure\Property::build('renewPrice', 'renew_price')
                ->type(Structure\DataType::FLOAT))
            ->addProperty(Structure\Property::build('checkingError', 'checking_error')
                ->type(Structure\DataType::STRING));
    }
}

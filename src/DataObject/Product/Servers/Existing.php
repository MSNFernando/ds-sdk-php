<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\Servers;

use Dreamscape\ResellerApiSdk\DataObject\Product\Base\AbstractExisting;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\DataType;

/**
 * @property-read string $location
 * @property-read string $operatingSystem
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Existing extends AbstractExisting
{
    protected static function describeStructure(): Structure
    {
        return parent::describeStructure()
            ->removeProperty('domainName')
            ->addProperty(
                Structure\Property::build('location')
                    ->type(DataType::STRING)
            )
            ->addProperty(
                Structure\Property::build('operatingSystem', 'operating_system')
                    ->type(DataType::STRING)
            );
    }
}

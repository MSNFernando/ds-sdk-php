<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Dictionary;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\Property;

/**
 * @property string $countryCode
 * @property string $countryName
 * @property string $stateCode
 * @property string $stateName
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class FaxToEmailLocation extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(Property::build('countryCode', 'country_code')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('countryName', 'country_name')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('stateCode', 'state_code')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('stateName', 'state_name')
                ->type(Structure\DataType::STRING));
    }
}

<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Reseller;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;

/**
 * @property int $id
 * @property string $locale
 * @property string $firstName
 * @property string $lastName
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Existing extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(Structure\Property::build('id')
                ->type(Structure\DataType::INTEGER))
            ->addProperty(Structure\Property::build('locale')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('firstName', 'first_name')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('lastName', 'last_name')
                ->type(Structure\DataType::STRING));
    }
}

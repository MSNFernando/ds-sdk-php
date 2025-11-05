<?php

namespace Dreamscape\ResellerApiSdk\Filter\Product\Plan\Feature;

use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\DataType;
use Dreamscape\ResellerApiSdk\Filter\AbstractFilter;

/**
 * Filters for the `$api->products->plans->features->getAll()` method.
 *
 * @property string[] $types
 * @method self setTypes(string[] $types)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class GetAll extends AbstractFilter
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(
                Structure\Property::build('types')
                    ->type(DataType::STRING_ARRAY)
            );
    }
}

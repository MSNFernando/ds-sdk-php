<?php

namespace Dreamscape\ResellerApiSdk\Filter\Product\Plan;

use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\DataType;
use Dreamscape\ResellerApiSdk\Filter\Pagination;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * Filters for the `$api->products->plans->getAll()` method.
 *
 * @property int $typeId
 * @method self setTypeId(int $type_id)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class GetAll extends Pagination
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return parent::describeStructure()
            ->addProperty(
                Structure\Property::build('typeId', 'type_id')
                    ->type(DataType::INTEGER)
                    ->rules(RuleSet::build()->addRule(Rule::notEmpty())
                        ->addRule(Rule::numberPositive()))
            );
    }
}

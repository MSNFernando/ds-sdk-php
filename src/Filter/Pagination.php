<?php

namespace Dreamscape\ResellerApiSdk\Filter;

use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * Implementation of filters for pagination.
 * The all filters that requires must pagination must be inherited from this class.
 *
 * @property int $page
 * @property int $limit
 *
 * @method $this setPage(int $page)
 * @method $this setLimit(int $limit)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
abstract class Pagination extends AbstractFilter
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(
                Structure\Property::build('page')
                    ->type(Structure\DataType::INTEGER)
                    ->rules(RuleSet::build()->addRule(Rule::numberPositive()))
            )
            ->addProperty(
                Structure\Property::build('limit')
                    ->type(Structure\DataType::INTEGER)
                    ->rules(RuleSet::build()->addRule(Rule::numberPositive()))
            );
    }
}

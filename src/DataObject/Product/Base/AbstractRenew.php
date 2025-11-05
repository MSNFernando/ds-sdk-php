<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\Base;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * @property int $period
 *
 * @method $this setPeriod(int $period)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
abstract class AbstractRenew extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(
                Structure\Property::build('period')
                    ->type(Structure\DataType::INTEGER)
                    ->rules(RuleSet::build()->addRule(Rule::numberPositive()))
            );
    }
}

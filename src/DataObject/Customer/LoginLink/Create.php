<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Customer\LoginLink;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\Property;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * @property int $productId
 *
 * @method $this setProductId(int $productId)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Create extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(Property::build('productId', 'product_id')
                ->type(Structure\DataType::INTEGER)
                ->rules(RuleSet::build()
                    ->addRule(Rule::notEmpty())
                    ->addRule(Rule::numberPositive())));
    }
}

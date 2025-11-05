<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\Base\LoginLink;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\Property;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * @property string $type
 *
 * @method $this setType(string $type)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
abstract class AbstractCreate extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(Property::build('type')
                ->type(Structure\DataType::STRING)
                ->rules(RuleSet::build()->addRule(Rule::notEmpty())))
            ;
    }
}

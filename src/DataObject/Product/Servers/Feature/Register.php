<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\Servers\Feature;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;
use Dreamscape\ResellerApiSdk\PredefinedValue;

/**
 * @property string $type
 * @property string $value
 * @property int $period
 *
 * @method $this setType(string $type)
 * @method $this setValue(string $value)
 * @method $this setPeriod(int $period)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Register extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(
                Structure\Property::build('type')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::allowedValues(PredefinedValue\Product\Servers\Feature::ALL_TYPES))
                    )
            )
            ->addProperty(
                Structure\Property::build('value')
                    ->type(Structure\DataType::STRING)
                    ->rules(RuleSet::build()
                        ->addRule(Rule::required())
                        ->addRule(Rule::notEmpty()))
            )
            ->addProperty(
                Structure\Property::build('period')
                    ->type(Structure\DataType::INTEGER)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::numberPositive())
                    )
            );
    }
}

<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\Base;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\DataType;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * @property int $customerId
 * @property int $planId
 * @property int $period
 *
 * @method $this setCustomerId(int $customer_id)
 * @method $this setPlanId(int $plan_id)
 * @method $this setPeriod(int $period)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
abstract class AbstractRegister extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(
                Structure\Property::build('customerId', 'customer_id')
                    ->type(DataType::INTEGER)
                    ->rules(
                        RuleSet::build()->addRule(Rule::required())
                            ->addRule(Rule::numberPositive())
                    )
            )
            ->addProperty(
                Structure\Property::build('domainName', 'domain_name')
                    ->type(DataType::STRING)
                    ->rules(
                        RuleSet::build()->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(2, 100))
                    )
            )
            ->addProperty(
                Structure\Property::build('planId', 'plan_id')
                    ->type(DataType::INTEGER)
                    ->rules(
                        RuleSet::build()->addRule(Rule::required())
                            ->addRule(Rule::numberPositive())
                    )
            )
            ->addProperty(
                Structure\Property::build('period')->type(DataType::INTEGER)
                    ->rules(
                        RuleSet::build()->addRule(Rule::required())
                            ->addRule(Rule::numberPositive())
                    )
            );
    }
}

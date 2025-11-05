<?php

namespace Dreamscape\ResellerApiSdk\Filter\Domain;

use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\Filter\AbstractFilter;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * Filters for the `$api->domains->checkAvailability()` method.
 *
 * @property string $currency
 * @property int $customerId
 *
 * @method $this setCurrency(string $currency)
 * @method $this setCustomerId(int $customer_id)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class CheckAvailability extends AbstractFilter
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(
                Structure\Property::build('currency')
                    ->type(Structure\DataType::STRING)
                    ->rules(RuleSet::build()->addRule(Rule::notEmpty()))
            )
            ->addProperty(
                Structure\Property::build('customerId', 'customer_id')
                    ->type(Structure\DataType::INTEGER)
                    ->rules(RuleSet::build()->addRule(Rule::numberPositive()))
            );
    }
}

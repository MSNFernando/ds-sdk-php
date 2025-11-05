<?php

namespace Dreamscape\ResellerApiSdk\Filter\Domain;

use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\Filter\Pagination;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * Filters for the `$api->domains->getAvailableTlds()` method.
 *
 * @property string[] $tlds
 * @property string $currency
 * @property int $customerId
 *
 * @method $this setTlds(array $tlds)
 * @method $this setCurrency(string $currency)
 * @method $this setCustomerId(string $customer_id)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class AvailableTlds extends Pagination
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return parent::describeStructure()
            ->addProperty(
                Structure\Property::build('tlds')
                    ->type(Structure\DataType::STRING_ARRAY)
                    ->rules(RuleSet::build()->addRule(Rule::notEmptyArray()))
            )
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

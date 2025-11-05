<?php

namespace Dreamscape\ResellerApiSdk\Filter\Domain\Registrant;

use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\DataType;
use Dreamscape\ResellerApiSdk\Filter\Pagination;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * Filter for the `$api->domains->registrants->getAll()`.
 *
 * @property int $customerId
 *
 * @method $this setCustomerId(int $customer_id)
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
                Structure\Property::build('customerId', 'customer_id')
                    ->type(DataType::INTEGER)
                    ->rules(RuleSet::build()->addRule(Rule::numberPositive()))
            );
    }
}

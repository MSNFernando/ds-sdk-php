<?php

namespace Dreamscape\ResellerApiSdk\Filter\Product\Base;

use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\DataType;
use Dreamscape\ResellerApiSdk\Filter\Pagination;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * @property int $customerId
 * @property int $statusId
 *
 * @method $this setCustomerId(int $customer_id)
 * @method $this setStatusId(int $status_id)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
abstract class AbstractGetAll extends Pagination
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
            )
            ->addProperty(
                Structure\Property::build('statusId', 'status_id')
                    ->type(DataType::INTEGER)
                    ->rules(RuleSet::build()->addRule(Rule::numberPositive()))
            );
    }
}

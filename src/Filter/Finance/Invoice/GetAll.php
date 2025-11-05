<?php

namespace Dreamscape\ResellerApiSdk\Filter\Finance\Invoice;

use DateTime;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\Filter\Pagination;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * Filters for the `$api->finances->invoices->getAll()` method.
 *
 * @property DateTime $fromDate
 * @property DateTime $toDate
 * @property int $customerId
 *
 * @method $this setFromDate(DateTime|string $from_date)
 * @method $this setToDate(DateTime|string $to_date)
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
                Structure\Property::build('fromDate', 'from_date')
                    ->type(Structure\DataType::DATETIME)
                    ->rules(RuleSet::build()->addRule(Rule::notEmpty()))
            )
            ->addProperty(
                Structure\Property::build('toDate', 'to_date')
                    ->type(Structure\DataType::DATETIME)
                    ->rules(RuleSet::build()->addRule(Rule::notEmpty()))
            )
            ->addProperty(
                Structure\Property::build('customerId', 'customer_id')
                    ->type(Structure\DataType::INTEGER)
                    ->rules(RuleSet::build()->addRule(Rule::numberPositive()))
            );
    }
}

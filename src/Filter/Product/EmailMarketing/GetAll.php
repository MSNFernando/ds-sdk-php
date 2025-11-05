<?php

namespace Dreamscape\ResellerApiSdk\Filter\Product\EmailMarketing;

use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\Filter\Product\Base\AbstractGetAll;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * Filters for the `$api->products->emailMarketings->getAll()` method.
 *
 * @property string $domainName
 *
 * @method $this setDomainName(string $domain_name)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class GetAll extends AbstractGetAll
{
    protected static function describeStructure(): Structure
    {
        return parent::describeStructure()
            ->addProperty(
                Structure\Property::build('domainName', 'domain_name')
                    ->type(Structure\DataType::STRING)
                    ->rules(RuleSet::build()->addRule(Rule::notEmpty()))
            );
    }
}

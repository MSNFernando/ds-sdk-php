<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\SiteBuilder;

use Dreamscape\ResellerApiSdk\DataObject\Product\Base\AbstractRegister;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\Validation\Rule;

/**
 * @property string $domainName
 * @method $this setDomainName(string $domain_name)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Register extends AbstractRegister
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        $structure = parent::describeStructure();
        $structure->getProperty('period')->rules
            ->removeRulesByType(Rule\Required::class);

        return $structure;
    }
}

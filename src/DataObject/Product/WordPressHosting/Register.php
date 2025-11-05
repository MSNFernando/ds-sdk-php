<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\WordPressHosting;

use Dreamscape\ResellerApiSdk\DataObject\Product\Base\AbstractRegister;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\DataType;
use Dreamscape\ResellerApiSdk\DataObject\Structure\Property;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;
use Dreamscape\ResellerApiSdk\PredefinedValue;

/**
 * @property string $domainName
 * @property string $location
 *
 * @method $this setDomainName(string $domain_name)
 * @method $this setLocation(string $location)
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
        $structure->getProperty('domainName')->rules
            ->removeRulesByType(Rule\Required::class);
        $structure->addProperty(
            Property::build('location')
                ->type(DataType::STRING)
                ->rules(
                    RuleSet::build()->addRule(Rule::required())
                        ->addRule(Rule::notEmpty())
                        ->addRule(Rule::allowedValues([
                            PredefinedValue\Product\WordPressHosting::LOCATION_AU,
                            PredefinedValue\Product\WordPressHosting::LOCATION_UK,
                        ]))
                )
        );

        return $structure;
    }
}

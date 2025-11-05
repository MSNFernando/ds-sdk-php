<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\FaxToEmail;

use Dreamscape\ResellerApiSdk\DataObject\Product\Base\AbstractRegister;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\DataType;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;
use Dreamscape\ResellerApiSdk\PredefinedValue;

/**
 * @property string $country
 * @property string $state
 *
 * @method $this setCountry(string $country)
 * @method $this setState(string $state)
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
        return parent::describeStructure()
            ->removeProperty('domainName')
            ->addProperty(
                Structure\Property::build('country')
                    ->type(DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::allowedValues([
                                PredefinedValue\Product\FaxToEmail::COUNTRY_AU,
                                PredefinedValue\Product\FaxToEmail::COUNTRY_UK,
                                PredefinedValue\Product\FaxToEmail::COUNTRY_NZ,
                            ]))
                    )
            )
            ->addProperty(
                Structure\Property::build('state')
                    ->type(DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(1, 50))
                    )
            );
    }
}

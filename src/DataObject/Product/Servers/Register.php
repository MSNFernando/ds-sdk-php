<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\Servers;

use Dreamscape\ResellerApiSdk\DataObject\Collection;
use Dreamscape\ResellerApiSdk\DataObject\Product\Base\AbstractRegister;
use Dreamscape\ResellerApiSdk\DataObject\Product\Servers\Feature;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\DataType;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;
use Dreamscape\ResellerApiSdk\PredefinedValue;

/**
 * @property string $location
 * @property string $operatingSystem
 * @property Feature\Register[]|Collection $features
 *
 * @method $this setLocation(string $location)
 * @method $this setOperatingSystem(string $operating_system)
 * @method $this setFeatures(Collection $features)
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
                Structure\Property::build('location')
                    ->type(DataType::STRING)
                    ->rules(RuleSet::build()
                        ->addRule(Rule::required())
                        ->addRule(Rule::notEmpty())
                        ->addRule(Rule::allowedValues(PredefinedValue\Product\Servers::ALL_LOCATIONS)))
            )
            ->addProperty(
                Structure\Property::build('operatingSystem', 'operating_system')
                    ->type(DataType::STRING)
                    ->rules(RuleSet::build()
                        ->addRule(Rule::required())
                        ->addRule(Rule::notEmpty()))
            )
            ->addProperty(
                Structure\Property::build('features')
                    ->collectionType(Feature\Register::class)
            );
    }
}

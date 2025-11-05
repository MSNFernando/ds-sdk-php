<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Domain\Host;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\Property;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * @property string $ip
 *
 * @method $this setIp(string $ip)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Update extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(
                Property::build('ip')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                    )
            );
    }
}

<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Domain\Transfer;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\PredefinedValue;

/**
 * @property int $domainId
 * @property string $authKey
 * @property string $type
 *
 * @method $this setDomainId(int $domain_id)
 * @method $this setAuthKey(string $auth_key)
 * @method $this setType(string $type)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Cancel extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(
                Structure\Property::build('domainId', 'domain_id')
                    ->type(Structure\DataType::INTEGER)
                    ->rules(
                        RuleSet::build()->addRule(Rule::required())
                            ->addRule(Rule::numberPositive())
                    )
            )
            ->addProperty(
                Structure\Property::build('authKey', 'auth_key')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(1, 255))
                    )
            )
            ->addProperty(
                Structure\Property::build('type')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::allowedValues([
                                PredefinedValue\Domain::TRANSFER_TYPE_IN,
                                PredefinedValue\Domain::TRANSFER_TYPE_OUT,
                            ]))
                    )
            );
    }
}

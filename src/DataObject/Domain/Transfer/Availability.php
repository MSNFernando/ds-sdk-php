<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Domain\Transfer;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\Rule\AbstractRule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * @property string $domainName
 * @property string $authKey
 * @property int $period
 *
 * @method $this setDomainName(string $domain_name)
 * @method $this setAuthKey(string $auth_key)
 * @method $this setPeriod(int $period)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Availability extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(
                Structure\Property::build('domainName', 'domain_name')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(2, 255))
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
                Structure\Property::build('period', 'period')
                    ->type(Structure\DataType::INTEGER)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::numberPositive())
                            ->addRule(Rule::custom(function (int $period) {
                                /** @var AbstractRule $this */
                                if ($period % 12 !== 0) {
                                    $this->error('Period should be a multiple of 12');

                                    return false;
                                }

                                return true;
                            }))
                    )
            );
    }
}

<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Domain\Transfer;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\Validation\Rule\AbstractRule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;
use Dreamscape\ResellerApiSdk\Validation\Rule;

/**
 * @property int $customerId
 * @property string $domainName
 * @property string $authKey
 * @property int $period
 * @property bool $confirmPremiumOrder
 *
 * @method $this setCustomerId(int $customer_id)
 * @method $this setDomainName(string $domain_name)
 * @method $this setAuthKey(string $auth_key)
 * @method $this setPeriod(int $period)
 * @method $this setConfirmPremiumOrder(bool $confirm_premium_order)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Start extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(
                Structure\Property::build('customerId', 'customer_id')
                    ->type(Structure\DataType::INTEGER)
                    ->rules(
                        RuleSet::build()->addRule(Rule::required())
                            ->addRule(Rule::numberPositive())
                    )
            )
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
            )
            ->addProperty(Structure\Property::build('confirmPremiumOrder', 'confirm_premium_order')
                ->type(Structure\DataType::BOOL));
    }
}

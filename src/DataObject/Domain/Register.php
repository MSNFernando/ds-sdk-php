<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Domain;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Collection;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\DataType;
use Dreamscape\ResellerApiSdk\DataObject\Structure\Property;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\Rule\AbstractRule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * @property string $domainName
 * @property int $period
 * @property int $customerId
 * @property int $registrantId
 * @property int $adminContactId
 * @property int $billingContactId
 * @property int $techContactId
 * @property NameServer\Create[]|Collection $nameServers
 * @property array $eligibility
 * @property bool $privacy
 * @property bool $confirmPremiumOrder
 *
 * @method $this setDomainName(string $domain_name)
 * @method $this setCustomerId(int $customer_id)
 * @method $this setRegistrantId(int $registrant_id)
 * @method $this setPeriod(int $period)
 * @method $this setAdminContactId(int $admin_contact_id)
 * @method $this setBillingContactId(int $billing_contact_id)
 * @method $this setTechContactId(int $tech_contact_id)
 * @method $this setNameServers(Collection $name_servers)
 * @method $this setEligibility(array $eligibility)
 * @method $this setPrivacy(bool $privacy)
 * @method $this setConfirmPremiumOrder(bool $confirm_premium_order)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Register extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        $validate_eligibility = function (array $eligibility): bool {
            /** @var AbstractRule $this */
            foreach ($eligibility as $index => $item) {
                if (!is_array($item)) {
                    $this->validationError('The eligibility item with index #' . $index . ' must be an array');

                    return false;
                }

                if (!isset($item['name'])) {
                    $this->validationError('The \'name\' key does not exist in the array with index #' . $index);

                    return false;
                }

                if (!isset($item['value'])) {
                    $this->validationError('The \'value\' key does not exist in the array with index #' . $index);

                    return false;
                }
            }

            return true;
        };

        return Structure::build()
            ->addProperty(
                Property::build('customerId', 'customer_id')
                    ->type(DataType::INTEGER)
                    ->rules(
                        RuleSet::build()->addRule(Rule::required())
                            ->addRule(Rule::numberPositive())
                    )
            )
            ->addProperty(
                Property::build('registrantId', 'registrant_id')
                    ->type(DataType::INTEGER)
                    ->rules(
                        RuleSet::build()->addRule(Rule::numberPositive())
                    )
            )
            ->addProperty(
                Property::build('domainName', 'domain_name')
                    ->type(DataType::STRING)
                    ->rules(
                        RuleSet::build()->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(2, 255))
                    )
            )
            ->addProperty(
                Property::build('period')
                    ->type(DataType::INTEGER)
                    ->rules(
                        RuleSet::build()->addRule(Rule::required())
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
            ->addProperty(
                Property::build('adminContactId', 'admin_contact_id')
                    ->type(DataType::INTEGER)
                    ->rules(RuleSet::build()->addRule(Rule::numberPositive()))
            )
            ->addProperty(
                Property::build('billingContactId', 'billing_contact_id')
                    ->type(DataType::INTEGER)
                    ->rules(RuleSet::build()->addRule(Rule::numberPositive()))
            )
            ->addProperty(
                Property::build('techContactId', 'tech_contact_id')
                    ->type(DataType::INTEGER)
                    ->rules(RuleSet::build()->addRule(Rule::numberPositive()))
            )
            ->addProperty(
                Property::build('nameServers', 'name_servers')
                    ->collectionType(NameServer\Create::class)
            )
            ->addProperty(
                Property::build('eligibility', 'eligibility_data')
                    ->type(DataType::ARRAY)
                    ->rules(
                        RuleSet::build()->addRule(Rule::notEmptyArray())
                            ->addRule(Rule::custom($validate_eligibility))
                    )
            )
            ->addProperty(Property::build('privacy')
                ->type(DataType::BOOL))
            ->addProperty(Property::build('confirmPremiumOrder', 'confirm_premium_order')
                ->type(DataType::BOOL));
    }
}

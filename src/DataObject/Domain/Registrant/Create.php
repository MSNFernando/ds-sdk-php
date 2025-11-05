<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Domain\Registrant;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\Property;
use Dreamscape\ResellerApiSdk\PredefinedValue;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * @property string $firstName
 * @property string $lastName
 * @property string $address
 * @property string $city
 * @property string $country
 * @property string $state
 * @property string $postCode
 * @property string $countryCode
 * @property string $phone
 * @property string $email
 * @property string $accountType
 * @property string $businessName
 * @property string $businessNumber
 * @property string $businessNumberType
 *
 * @method $this setFirstName(string $first_name)
 * @method $this setLastName(string $last_name)
 * @method $this setAddress(string $address)
 * @method $this setCity(string $city)
 * @method $this setCountry(string $country)
 * @method $this setState(string $state)
 * @method $this setPostCode(string $post_code)
 * @method $this setCountryCode(string $country_code)
 * @method $this setPhone(string $phone)
 * @method $this setEmail(string $email)
 * @method $this setAccountType(string $account_type)
 * @method $this setBusinessName(string $business_name)
 * @method $this setBusinessNumberType(string $business_number_type)
 * @method $this setBusinessNumber(string $business_number)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Create extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(
                Property::build('firstName', 'first_name')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(1, 50))
                    )
            )
            ->addProperty(
                Property::build('lastName', 'last_name')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(1, 50))
                    )
            )
            ->addProperty(
                Property::build('address')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(1, 255))
                    )
            )
            ->addProperty(
                Property::build('city')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(1, 100))
                    )
            )
            ->addProperty(
                Property::build('country')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(2, 2))
                    )
            )
            ->addProperty(
                Property::build('state')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(1, 50))
                    )
            )
            ->addProperty(
                Property::build('postCode', 'post_code')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(1, 15))
                    )
            )
            ->addProperty(
                Property::build('countryCode', 'country_code')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(1, 4))
                    )
            )
            ->addProperty(
                Property::build('phone')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::phoneNumber())
                    )
            )
            ->addProperty(
                Property::build('email')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(2, 255))
                            ->addRule(Rule::email())
                    )
            )
            ->addProperty(
                Property::build('accountType', 'account_type')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::allowedValues([
                                PredefinedValue\Customer::ACCOUNT_TYPE_PERSONAL,
                                PredefinedValue\Customer::ACCOUNT_TYPE_BUSINESS,
                            ]))
                    )
            )
            ->addProperty(
                Property::build('businessName', 'business_name')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(2, 255))
                    )
            )
            ->addProperty(
                Property::build('businessNumberType', 'business_number_type')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::allowedValues(PredefinedValue\Customer::BUSINESS_NUMBER_TYPES))
                    )
            )
            ->addProperty(
                Property::build('businessNumber', 'business_number')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(2, 25))
                    )
            );
    }
}

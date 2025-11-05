<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\SslCertificate;

use Dreamscape\ResellerApiSdk\DataObject\Product\Base\AbstractRegister;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\DataType;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;
use Dreamscape\ResellerApiSdk\PredefinedValue;

/**
 * @property string $domainName
 * @property string $hostedWith
 * @property int $serverSoftware
 * @property string $csr
 * @property bool $autoFillDetails
 * @property string $accountType
 * @property string $address
 * @property string $city
 * @property string $postCode
 * @property string $country
 * @property string $state
 * @property string $phone
 * @property string $email
 * @property string $businessName
 * @property string $businessNumber
 * @property string $jurisdictionCountry
 *
 * @method $this setDomainName(string $domain_name)
 * @method $this setHostedWith(string $hosted_with)
 * @method $this setServerSoftware(int $server_software)
 * @method $this setCsr(string $csr)
 * @method $this setAutoFillDetails(bool $auto_fill_details)
 * @method $this setAccountType(string $account_type)
 * @method $this setAddress(string $address)
 * @method $this setCity(string $city)
 * @method $this setPostCode(string $post_code)
 * @method $this setCountry(string $country)
 * @method $this setState(string $state)
 * @method $this setPhone(string $phone)
 * @method $this setEmail(string $email)
 * @method $this setBusinessName(string $business_name)
 * @method $this setBusinessNumber(string $business_number)
 * @method $this setJurisdictionCountry(string $jurisdiction_country)
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
            ->addProperty(
                Structure\Property::build('hostedWith', 'hosted_with')
                    ->type(DataType::STRING)
                    ->rules(
                        RuleSet::build()->addRule(Rule::notEmpty())
                            ->addRule(Rule::allowedValues([
                                PredefinedValue\Product\SslCertificate::HOSTED_WITH_EXTERNAL,
                                PredefinedValue\Product\SslCertificate::HOSTED_WITH_DREAMSCAPE,
                            ]))
                    )
            )
            ->addProperty(
                Structure\Property::build('serverSoftware', 'server_software')
                    ->type(DataType::INTEGER)
                    ->rules(RuleSet::build()->addRule(Rule::numberPositive()))
            )
            ->addProperty(
                Structure\Property::build('csr')
                    ->type(DataType::STRING)
                    ->rules(RuleSet::build()->addRule(Rule::notEmpty()))
            )
            ->addProperty(
                Structure\Property::build('autoFillDetails', 'auto_fill_details')
                    ->type(DataType::BOOL)
            )
            ->addProperty(
                Structure\Property::build('accountType', 'account_type')
                    ->type(DataType::STRING)
                    ->rules(
                        RuleSet::build()->addRule(Rule::notEmpty())
                            ->addRule(Rule::allowedValues([
                                PredefinedValue\Product\SslCertificate::ACCOUNT_TYPE_PERSONAL,
                                PredefinedValue\Product\SslCertificate::ACCOUNT_TYPE_BUSINESS,
                            ]))
                    )
            )
            ->addProperty(
                Structure\Property::build('address')
                    ->type(DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(1, 255))
                    )
            )
            ->addProperty(
                Structure\Property::build('city')
                    ->type(DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(1, 100))
                    )
            )
            ->addProperty(
                Structure\Property::build('postCode', 'post_code')
                    ->type(DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(1, 15))
                    )
            )
            ->addProperty(
                Structure\Property::build('country')
                    ->type(DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(2, 2))
                    )
            )
            ->addProperty(
                Structure\Property::build('state')
                    ->type(DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(1, 50))
                    )
            )
            ->addProperty(
                Structure\Property::build('phone')
                    ->type(DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::phoneNumber())
                    )
            )
            ->addProperty(
                Structure\Property::build('email')
                    ->type(DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(2, 255))
                            ->addRule(Rule::email())
                    )
            )
            ->addProperty(
                Structure\Property::build('businessName', 'business_name')
                    ->type(DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(2, 255))
                    )
            )
            ->addProperty(
                Structure\Property::build('businessNumber', 'business_number')
                    ->type(DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(2, 25))
                    )
            )
            ->addProperty(
                Structure\Property::build('jurisdictionCountry', 'jurisdiction_country')
                    ->type(DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(2, 2))
                    )
            );
    }
}

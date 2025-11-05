<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\SslCertificate\Reissue;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * @property string $commonName
 * @property string $organization
 * @property string $organizationUnit
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $email
 * @property int $serverSoftware
 *
 * @method $this setCommonName(string $commonName)
 * @method $this setOrganization(string $organization)
 * @method $this setOrganizationUnit(string $organizationUnit)
 * @method $this setCountry(string $country)
 * @method $this setState(string $state)
 * @method $this setCity(string $city)
 * @method $this setEmail(string $email)
 * @method $this setServerSoftware(int $serverSoftware)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Auto extends AbstractDataObject
{
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(
                Structure\Property::build('commonName', 'common_name')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(2, 100))
                    )
            )
            ->addProperty(
                Structure\Property::build('organization')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(2, 255))
                    )
            )
            ->addProperty(
                Structure\Property::build('organizationUnit', 'organization_unit')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(2, 255))
                    )
            )
            ->addProperty(
                Structure\Property::build('country')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(2, 2))
                    )
            )
            ->addProperty(
                Structure\Property::build('state')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(1, 50))
                    )
            )
            ->addProperty(
                Structure\Property::build('city')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(1, 100))
                    )
            )
            ->addProperty(
                Structure\Property::build('email')
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
                Structure\Property::build('serverSoftware', 'server_software')
                    ->type(Structure\DataType::INTEGER)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::numberPositive())
                    )
            );
    }
}

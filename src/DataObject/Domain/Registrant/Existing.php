<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Domain\Registrant;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;

/**
 * @property int $id
 * @property int $customerId
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
 * @property string $businessNumberType
 * @property string $businessNumber
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Existing extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(Structure\Property::build('id')
                ->type(Structure\DataType::INTEGER))
            ->addProperty(Structure\Property::build('customerId', 'customer_id')
                ->type(Structure\DataType::INTEGER))
            ->addProperty(Structure\Property::build('firstName', 'first_name')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('lastName', 'last_name')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('address')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('city')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('country')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('state')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('postCode', 'post_code')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('countryCode', 'country_code')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('phone')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('email')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('accountType', 'account_type')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('businessName', 'business_name')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('businessNumberType', 'business_number_type')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('businessNumber', 'business_number')
                ->type(Structure\DataType::STRING));
    }
}

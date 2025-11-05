<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Customer;

use DateTime;
use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\Property;

/**
 * @property int $id
 * @property int $statusId
 * @property string $username
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
 * @property string $currency
 * @property string $accountType
 * @property string $mobile
 * @property string $businessName
 * @property string $businessNumber
 * @property string $businessNumberType
 * @property DateTime $dateAdded
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
            ->addProperty(Property::build('id')
                ->type(Structure\DataType::INTEGER))
            ->addProperty(Property::build('statusId', 'status_id')
                ->type(Structure\DataType::INTEGER))
            ->addProperty(Property::build('username')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('firstName', 'first_name')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('lastName', 'last_name')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('address')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('city')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('country')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('state')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('postCode', 'post_code')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('countryCode', 'country_code')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('phone')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('mobile')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('email')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('currency')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('accountType', 'account_type')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('businessName', 'business_name')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('businessNumber', 'business_number')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('businessNumberType', 'business_number_type')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('dateAdded', 'date_added')
                ->type(Structure\DataType::DATETIME));
    }
}

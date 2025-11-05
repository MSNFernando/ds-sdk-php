<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Domain\Transfer;

use DateTime;
use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;

/**
 * @property bool $isAvailable
 * @property bool $isEligibleForRenewal
 * @property bool $isRenewalRequired
 * @property bool $isPremium
 * @property float $renewPrice
 * @property DateTime $expiryDate
 * @property array $allowedRenewalPeriods
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class AvailabilityResult extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(Structure\Property::build('isAvailable', 'status')
                ->type(Structure\DataType::BOOL))
            ->addProperty(Structure\Property::build('isEligibleForRenewal', 'eligible_for_renewal')
                ->type(Structure\DataType::BOOL))
            ->addProperty(Structure\Property::build('isRenewalRequired', 'renewal_required')
                ->type(Structure\DataType::BOOL))
            ->addProperty(Structure\Property::build('isPremium', 'is_premium')
                ->type(Structure\DataType::BOOL))
            ->addProperty(Structure\Property::build('renewPrice', 'renew_price')
                ->type(Structure\DataType::FLOAT))
            ->addProperty(Structure\Property::build('expiryDate', 'expiry_date')
                ->type(Structure\DataType::DATETIME))
            ->addProperty(Structure\Property::build('allowedRenewalPeriods', 'allowed_renewal_periods')
                ->type(Structure\DataType::ARRAY));
    }
}

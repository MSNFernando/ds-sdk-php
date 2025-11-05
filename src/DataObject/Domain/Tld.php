<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Domain;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;

/**
 * @property string $tld
 * @property int $minPeriod
 * @property int $maxPeriod
 * @property TldPrice $price
 * @property bool $eligibilityRequired
 * @property bool $privacyAllowed
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Tld extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(Structure\Property::build('tld')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('minPeriod', 'min_period')
                ->type(Structure\DataType::INTEGER))
            ->addProperty(Structure\Property::build('maxPeriod', 'max_period')
                ->type(Structure\DataType::INTEGER))
            ->addProperty(Structure\Property::build('price')
                ->dataObjectType(TldPrice::class))
            ->addProperty(Structure\Property::build('eligibilityRequired', 'eligibility_required')
                ->type(Structure\DataType::BOOL))
            ->addProperty(Structure\Property::build('privacyAllowed', 'privacy_allowed')
                ->type(Structure\DataType::BOOL));
    }
}

<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Domain\DNS\Existing;

use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\Property;
use Dreamscape\ResellerApiSdk\PredefinedValue;

/**
 * @property string $email
 * @property string $forwardTo
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class MAILFWD extends AbstractRecord
{
    /**
     * @inheritDoc
     */
    protected static function defineRecordType(): string
    {
        return PredefinedValue\Domain\DNS::MAILFWD;
    }

    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return parent::describeStructure()
            ->addProperty(Property::build('email')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('forwardTo', 'forward_to')
                ->type(Structure\DataType::STRING));
    }
}

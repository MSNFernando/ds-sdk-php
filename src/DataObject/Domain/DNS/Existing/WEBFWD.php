<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Domain\DNS\Existing;

use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\Property;
use Dreamscape\ResellerApiSdk\PredefinedValue;

/**
 * @property string $subdomain
 * @property string $forwardTo
 * @property bool $cloak
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class WEBFWD extends AbstractRecord
{
    /**
     * @inheritDoc
     */
    protected static function defineRecordType(): string
    {
        return PredefinedValue\Domain\DNS::WEBFWD;
    }

    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return parent::describeStructure()
            ->addProperty(Property::build('subdomain')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('forwardTo', 'forward_to')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('cloak')
                ->type(Structure\DataType::BOOL));
    }
}

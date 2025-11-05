<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\DnsHosting\DNS\Existing;

use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\Property;
use Dreamscape\ResellerApiSdk\PredefinedValue;

/**
 * @property string $subdomain
 * @property int $weight
 * @property int $port
 * @property string $target
 * @property int $priority
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class SRV extends AbstractRecord
{
    /**
     * @inheritDoc
     */
    protected static function defineRecordType(): string
    {
        return PredefinedValue\Domain\DNS::SRV;
    }

    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return parent::describeStructure()
            ->addProperty(Property::build('subdomain')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('weight')
                ->type(Structure\DataType::INTEGER))
            ->addProperty(Property::build('port')
                ->type(Structure\DataType::INTEGER))
            ->addProperty(Property::build('target')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('priority')
                ->type(Structure\DataType::INTEGER));
    }
}

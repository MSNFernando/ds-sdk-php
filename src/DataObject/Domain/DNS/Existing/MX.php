<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Domain\DNS\Existing;

use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\Property;
use Dreamscape\ResellerApiSdk\PredefinedValue;

/**
 * @property string $subdomain
 * @property string $content
 * @property int $priority
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class MX extends AbstractRecord
{
    /**
     * @inheritDoc
     */
    protected static function defineRecordType(): string
    {
        return PredefinedValue\Domain\DNS::MX;
    }

    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return parent::describeStructure()
            ->addProperty(Property::build('subdomain')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('content')
                ->type(Structure\DataType::STRING))
            ->addProperty(Property::build('priority')
                ->type(Structure\DataType::INTEGER));
    }
}

<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Domain\DNS\Existing;

use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\Property;
use Dreamscape\ResellerApiSdk\PredefinedValue;

/**
 * @property string $subdomain
 * @property string $content
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class CNAME extends AbstractRecord
{
    /**
     * @inheritDoc
     */
    protected static function defineRecordType(): string
    {
        return PredefinedValue\Domain\DNS::CNAME;
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
                ->type(Structure\DataType::STRING));
    }
}

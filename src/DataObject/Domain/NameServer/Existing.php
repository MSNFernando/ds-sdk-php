<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Domain\NameServer;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * @property string $ip
 * @property string $host
 *
 * @method $this setHost(string $host)
 * @method $this setIp(string $ip)
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
            ->addProperty(Structure\Property::build('host')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('ip')
                ->type(Structure\DataType::STRING));
    }
}

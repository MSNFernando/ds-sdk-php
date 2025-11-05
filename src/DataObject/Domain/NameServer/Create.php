<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Domain\NameServer;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\Rule\AbstractRule;
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
class Create extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(
                Structure\Property::build('host')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(1, 255))
                    )
            )
            ->addProperty(
                Structure\Property::build('ip')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(1, 56))
                            ->addRule(Rule::ipAddress(Rule\IpAddress::TYPE_BOTH))
                    )
            );
    }
}

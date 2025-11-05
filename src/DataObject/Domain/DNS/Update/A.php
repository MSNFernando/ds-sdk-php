<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Domain\DNS\Update;

use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\Property;
use Dreamscape\ResellerApiSdk\PredefinedValue;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * @property string $subdomain
 * @property string $content
 *
 * @method $this setSubdomain(string $subdomain)
 * @method $this setContent(string $content)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class A extends AbstractRecord
{
    /**
     * @inheritDoc
     */
    protected static function defineRecordType(): string
    {
        return PredefinedValue\Domain\DNS::A;
    }

    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(Property::build('subdomain')
                ->type(Structure\DataType::STRING)
                ->rules(RuleSet::build()->addRule(Rule::lengthBetween(0, 255))))
            ->addProperty(
                Property::build('content')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::ipAddress(Rule\IpAddress::TYPE_IPV4))
                    )
            );
    }
}

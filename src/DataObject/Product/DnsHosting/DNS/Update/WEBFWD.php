<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\DnsHosting\DNS\Update;

use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\Property;
use Dreamscape\ResellerApiSdk\PredefinedValue;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * @property string $subdomain
 * @property string $forwardTo
 * @property bool $cloak
 *
 * @method $this setSubdomain(string $subdomain)
 * @method $this setForwardTo(string $forward_to)
 * @method $this setCloak(bool $cloak)
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
        return Structure::build()
            ->addProperty(Property::build('subdomain')
                ->type(Structure\DataType::STRING)
                ->rules(RuleSet::build()->addRule(Rule::lengthBetween(0, 255))))
            ->addProperty(
                Property::build('forwardTo', 'forward_to')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(1, 1000))
                    )
            )
            ->addProperty(Property::build('cloak')
                ->type(Structure\DataType::BOOL));
    }
}

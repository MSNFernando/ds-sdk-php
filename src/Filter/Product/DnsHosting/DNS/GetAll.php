<?php

namespace Dreamscape\ResellerApiSdk\Filter\Product\DnsHosting\DNS;

use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\Filter\AbstractFilter;
use Dreamscape\ResellerApiSdk\PredefinedValue;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * Filters for the `$api->products->dnsHostings->dns->getAll()` method.
 *
 * @property string $type
 *
 * @method $this setType(string $type)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class GetAll extends AbstractFilter
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(
                Structure\Property::build('type')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()->addRule(Rule::notEmpty())
                            ->addRule(Rule::allowedValues([
                                PredefinedValue\Domain\DNS::A,
                                PredefinedValue\Domain\DNS::AAAA,
                                PredefinedValue\Domain\DNS::CAA,
                                PredefinedValue\Domain\DNS::CNAME,
                                PredefinedValue\Domain\DNS::MX,
                                PredefinedValue\Domain\DNS::SRV,
                                PredefinedValue\Domain\DNS::TXT,
                                PredefinedValue\Domain\DNS::MAILFWD,
                                PredefinedValue\Domain\DNS::WEBFWD,
                            ]))
                    )
            );
    }
}

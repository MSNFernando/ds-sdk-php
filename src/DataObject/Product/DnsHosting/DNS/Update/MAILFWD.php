<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\DnsHosting\DNS\Update;

use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\Property;
use Dreamscape\ResellerApiSdk\PredefinedValue;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * @property string $email
 * @property string $forwardTo
 *
 * @method $this setEmail(string $email)
 * @method $this setForwardTo(string $forward_to)
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
        return Structure::build()
            ->addProperty(
                Property::build('email')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(1, 255))
                    )
            )
            ->addProperty(
                Property::build('forwardTo', 'forward_to')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(1, 1000))
                            ->addRule(Rule::email())
                    )
            );
    }
}

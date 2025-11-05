<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\DnsHosting\DNS\Update;

use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\Property;
use Dreamscape\ResellerApiSdk\PredefinedValue;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * @property int $flag
 * @property string $tag
 * @property string $value
 *
 * @method $this setFlag(int $flag)
 * @method $this setTag(string $tag)
 * @method $this setValue(string $value)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class CAA extends AbstractRecord
{
    /**
     * @inheritDoc
     */
    protected static function defineRecordType(): string
    {
        return PredefinedValue\Domain\DNS::CAA;
    }

    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(
                Property::build('flag')
                    ->type(Structure\DataType::INTEGER)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::numberGreaterEqual(0))
                            ->addRule(Rule::allowedValues(PredefinedValue\Domain\DNS::CAA_FLAG_VALUES))
                    )
            )
            ->addProperty(
                Property::build('tag')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::allowedValues(PredefinedValue\Domain\DNS::CAA_TAG_VALUES))
                    )
            )
            ->addProperty(
                Property::build('value')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(1, 1000))
                    )
            );
    }
}

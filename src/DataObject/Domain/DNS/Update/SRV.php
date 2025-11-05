<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Domain\DNS\Update;

use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\Property;
use Dreamscape\ResellerApiSdk\PredefinedValue;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * @property string $subdomain
 * @property int $weight
 * @property int $port
 * @property string $target
 * @property int $priority
 *
 * @method $this setSubdomain(string $subdomain)
 * @method $this setWeight(int $weight)
 * @method $this setPort(int $port)
 * @method $this setTarget(string $target)
 * @method $this setPriority(int $priority)
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
        return Structure::build()
            ->addProperty(
                Property::build('subdomain')
                    ->type(Structure\DataType::STRING)
                    ->rules(RuleSet::build()->addRule(Rule::lengthBetween(0, 255)))
            )
            ->addProperty(
                Property::build('weight')
                    ->type(Structure\DataType::INTEGER)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::numberGreaterEqual(0))
                            ->addRule(Rule::numberLessEqual(65535))
                    )
            )
            ->addProperty(
                Property::build('port')
                    ->type(Structure\DataType::INTEGER)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::numberGreaterEqual(0))
                            ->addRule(Rule::numberLessEqual(65535))
                    )
            )
            ->addProperty(
                Property::build('target')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::lengthBetween(1, 1000))
                    )
            )
            ->addProperty(
                Property::build('priority')
                    ->type(Structure\DataType::INTEGER)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::numberGreaterEqual(0))
                            ->addRule(Rule::numberLessEqual(65535))
                    )
            );
    }
}

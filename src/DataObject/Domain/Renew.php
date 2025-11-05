<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Domain;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\Rule\AbstractRule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * @property int $period
 * @property bool $privacy
 *
 * @method $this setPeriod(int $period)
 * @method $this setPrivacy(bool $privacy)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Renew extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(
                Structure\Property::build('period')
                    ->type(Structure\DataType::INTEGER)
                    ->rules(
                        RuleSet::build()->addRule(Rule::numberPositive())
                            ->addRule(Rule::custom(function (int $period) {
                                /** @var AbstractRule $this */
                                if ($period % 12 !== 0) {
                                    $this->error('Period should be a multiple of 12');

                                    return false;
                                }

                                return true;
                            }))
                    )
            )
            ->addProperty(Structure\Property::build('privacy')
                ->type(Structure\DataType::BOOL));
    }
}

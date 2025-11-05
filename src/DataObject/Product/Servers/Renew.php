<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\Servers;

use Dreamscape\ResellerApiSdk\DataObject\Collection;
use Dreamscape\ResellerApiSdk\DataObject\Product\Base\AbstractRenew;
use Dreamscape\ResellerApiSdk\DataObject\Structure;

/**
 * @property Feature\Renew[]|Collection $features
 *
 * @method $this setFeatures(Collection $period)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Renew extends AbstractRenew
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return parent::describeStructure()
            ->addProperty(
                Structure\Property::build('features')
                    ->collectionType(Feature\Renew::class)
            );
    }
}

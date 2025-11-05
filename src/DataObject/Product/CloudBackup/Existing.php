<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\CloudBackup;

use Dreamscape\ResellerApiSdk\DataObject\Product\Base\AbstractExisting;
use Dreamscape\ResellerApiSdk\DataObject\Structure;

/**
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Existing extends AbstractExisting
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return parent::describeStructure()
            ->removeProperty('domainName');
    }
}

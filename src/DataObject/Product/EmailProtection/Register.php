<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\EmailProtection;

use Dreamscape\ResellerApiSdk\DataObject\Product\Base\AbstractRegister;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\DataType;
use Dreamscape\ResellerApiSdk\DataObject\Structure\Property;

/**
 * @property string $domainName
 * @property bool $freeTrial
 * @method $this setDomainName(string $domain_name)
 * @method $this setFreeTrial(bool $free_trial)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Register extends AbstractRegister
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return parent::describeStructure()
            ->addProperty(
                Property::build('freeTrial', 'free_trial')
                    ->type(DataType::BOOL)
            );
    }
}

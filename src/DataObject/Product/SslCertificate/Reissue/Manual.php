<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\SslCertificate\Reissue;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * @property string $csr
 * @property int $serverSoftware
 *
 * @method $this setCsr(string $csr)
 * @method $this setServerSoftware(int $serverSoftware)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Manual extends AbstractDataObject
{
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(
                Structure\Property::build('csr')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                    )
            )
            ->addProperty(
                Structure\Property::build('serverSoftware', 'server_software')
                    ->type(Structure\DataType::INTEGER)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::numberPositive())
                    )
            );
    }
}

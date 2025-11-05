<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\SslCertificate\Dcv;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;
use Dreamscape\ResellerApiSdk\PredefinedValue;

/**
 * @property string $method
 * @property string $email
 *
 * @method $this setMethod(string $method)
 * @method $this setEmail(string $email)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Update extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(
                Structure\Property::build('method')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::required())
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::allowedValues([
                                PredefinedValue\Product\SslCertificate::DCV_METHOD_EMAIL,
                                PredefinedValue\Product\SslCertificate::DCV_METHOD_HTTP,
                                PredefinedValue\Product\SslCertificate::DCV_METHOD_CNAME,
                            ]))
                    )
            )
            ->addProperty(
                Structure\Property::build('email')
                    ->type(Structure\DataType::STRING)
                    ->rules(
                        RuleSet::build()
                            ->addRule(Rule::notEmpty())
                            ->addRule(Rule::email())
                    )
            )
            ;
    }
}

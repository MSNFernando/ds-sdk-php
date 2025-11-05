<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\SslCertificate\Dcv;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;

/**
 * @property string $email
 * @property string[] $availableEmails
 *
 * @method string getEmail()
 * @method $this setAvailableEmails(string[] $availableEmails)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Email extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(
                Structure\Property::build('email')
                    ->type(Structure\DataType::STRING)
            )
            ->addProperty(
                Structure\Property::build('availableEmails', 'available_emails')
                    ->type(Structure\DataType::STRING_ARRAY)
            )
            ;
    }
}

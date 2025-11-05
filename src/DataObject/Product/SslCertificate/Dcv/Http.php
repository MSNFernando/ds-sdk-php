<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\SslCertificate\Dcv;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;

/**
 * @property string $name
 * @property string $path
 * @property string $url
 * @property string $content
 *
 * @method $this setName(string $name)
 * @method $this setPath(string $path)
 * @method $this setUrl(string $url)
 * @method $this setContent(string $content)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Http extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(
                Structure\Property::build('name')
                    ->type(Structure\DataType::STRING)
            )
            ->addProperty(
                Structure\Property::build('path')
                    ->type(Structure\DataType::STRING)
            )
            ->addProperty(
                Structure\Property::build('url')
                    ->type(Structure\DataType::STRING)
            )
            ->addProperty(
                Structure\Property::build('content')
                    ->type(Structure\DataType::STRING)
            )
            ;
    }
}

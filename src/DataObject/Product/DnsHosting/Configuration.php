<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\DnsHosting;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;

/**
 * @property bool $isDnsManagementAvailable
 * @property string[] $availableRecordTypes
 * @property string[] $nameServers
 * @property int[] $mxPriorities
 * @property int[] $caaFlags
 * @property string[] $caaTags
 *
 * @method $this setIsDnsManagementAvailable(bool $isDnsManagementAvailable)
 * @method $this setAvailableRecordTypes(string[] $availableRecordTypes)
 * @method $this setNameServers(string[] $nameServers)
 * @method $this setMxPriorities(int[] $mxPriorities)
 * @method $this setCaaFlags(int[] $caaFlags)
 * @method $this setCaaTags(string[] $caaTags)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Configuration extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(
                Structure\Property::build('isDnsManagementAvailable', 'is_dns_management_available')
                    ->type(Structure\DataType::BOOL)
            )
            ->addProperty(
                Structure\Property::build('availableRecordTypes', 'available_record_types')
                    ->type(Structure\DataType::STRING_ARRAY)
            )
            ->addProperty(
                Structure\Property::build('nameServers', 'name_servers')
                    ->type(Structure\DataType::STRING_ARRAY)
            )
            ->addProperty(
                Structure\Property::build('mxPriorities', 'mx_priorities')
                    ->type(Structure\DataType::INTEGER_ARRAY)
            )
            ->addProperty(
                Structure\Property::build('caaFlags', 'caa_flags')
                    ->type(Structure\DataType::INTEGER_ARRAY)
            )
            ->addProperty(
                Structure\Property::build('caaTags', 'caa_tags')
                    ->type(Structure\DataType::STRING_ARRAY)
            );
    }
}

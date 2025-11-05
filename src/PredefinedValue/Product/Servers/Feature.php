<?php

namespace Dreamscape\ResellerApiSdk\PredefinedValue\Product\Servers;

/**
 * Predefined values for Servers feature.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Feature
{
    #region Types

    public const TYPE_HOSTING_MANAGER = 'hosting_manager';
    public const TYPE_SSD = 'ssd';
    public const TYPE_RAM = 'ram';
    public const TYPE_CORE = 'core';
    public const TYPE_IP = 'ip';
    public const TYPE_BANDWIDTH = 'bandwidth';

    public const ALL_TYPES = [
        self::TYPE_HOSTING_MANAGER,
        self::TYPE_SSD,
        self::TYPE_RAM,
        self::TYPE_CORE,
        self::TYPE_IP,
        self::TYPE_BANDWIDTH,
    ];

    #endregion
}

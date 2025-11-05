<?php

namespace Dreamscape\ResellerApiSdk\PredefinedValue\Product;

/**
 * Predefined values for Servers product.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Servers
{
    #region Operating System

    public const OPERATING_SYSTEM_FAMILY_WINDOWS = 'windows';
    public const OPERATING_SYSTEM_FAMILY_LINUX = 'linux';

    #endregion

    #region Location

    public const LOCATION_AU = 'AU';
    public const LOCATION_UK = 'UK';

    public const ALL_LOCATIONS = [
        self::LOCATION_AU,
        self::LOCATION_UK,
    ];

    #endregion
}

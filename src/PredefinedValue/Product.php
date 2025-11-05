<?php

namespace Dreamscape\ResellerApiSdk\PredefinedValue;

/**
 * Predefined values for products.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Product
{
    #region Products statuses

    public const STATUS_AWAITING_REGISTRATION = 1;
    public const STATUS_REGISTERED = 2;
    public const STATUS_AWAITING_RENEWAL = 3;
    public const STATUS_AWAITING_DELETED = 4;
    public const STATUS_DELETED = 5;
    public const STATUS_EXPIRED = 6;
    public const STATUS_ERROR = 7;

    #endregion
}

<?php

namespace Dreamscape\ResellerApiSdk\PredefinedValue;

/**
 * Predefined values for domains.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Domain
{
    #region Domain statuses

    public const STATUS_AWAITING_REGISTRATION = 1;
    public const STATUS_REGISTERED = 2;
    public const STATUS_AWAITING_RENEWAL = 3;
    public const STATUS_AWAITING_DELETED = 4;
    public const STATUS_DELETED = 5;
    public const STATUS_EXPIRED = 6;
    public const STATUS_AWAITING_TRANSFER_IN = 7;
    public const STATUS_AWAITING_TRANSFER_OUT = 8;
    public const STATUS_ERROR = 9;

    #endregion

    #region Transfer types

    public const TRANSFER_TYPE_IN = 'in';
    public const TRANSFER_TYPE_OUT = 'out';

    #endregion
}

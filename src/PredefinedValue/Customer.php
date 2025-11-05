<?php

namespace Dreamscape\ResellerApiSdk\PredefinedValue;

/**
 * Predefined values for customers.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Customer
{
    #region Statuses

    public const STATUS_ACTIVE = 1;
    public const STATUS_PENDING = 2;
    public const STATUS_SUSPENDED = 3;
    public const STATUS_DISABLED = 4;
    public const STATUS_TERMINATED = 5;

    #endregion

    #region Account types

    public const ACCOUNT_TYPE_PERSONAL = 'personal';
    public const ACCOUNT_TYPE_BUSINESS = 'business';

    #endregion

    #region Business number types

    public const BUSINESS_ID_TYPE_ABN = 'ABN';
    public const BUSINESS_ID_TYPE_ACN = 'ACN';
    public const BUSINESS_ID_TYPE_EBR = 'EBR';
    public const BUSINESS_ID_TYPE_VIC = 'VIC';
    public const BUSINESS_ID_TYPE_NSW = 'NSW';
    public const BUSINESS_ID_TYPE_SA = 'SA';
    public const BUSINESS_ID_TYPE_ACT = 'ACT';
    public const BUSINESS_ID_TYPE_QLD = 'QLD';
    public const BUSINESS_ID_TYPE_NT = 'NT';
    public const BUSINESS_ID_TYPE_WA = 'WA';
    public const BUSINESS_ID_TYPE_TAS = 'TAS';
    public const BUSINESS_ID_TYPE_TM = 'TM';
    public const BUSINESS_ID_TYPE_OTHER = 'OTHER';

    public const BUSINESS_NUMBER_TYPES = [
        self::BUSINESS_ID_TYPE_ABN,
        self::BUSINESS_ID_TYPE_EBR,
        self::BUSINESS_ID_TYPE_ACN,
        self::BUSINESS_ID_TYPE_VIC,
        self::BUSINESS_ID_TYPE_NSW,
        self::BUSINESS_ID_TYPE_SA,
        self::BUSINESS_ID_TYPE_NT,
        self::BUSINESS_ID_TYPE_WA,
        self::BUSINESS_ID_TYPE_TAS,
        self::BUSINESS_ID_TYPE_ACT,
        self::BUSINESS_ID_TYPE_QLD,
        self::BUSINESS_ID_TYPE_TM,
        self::BUSINESS_ID_TYPE_OTHER,
    ];

    #endregion
}

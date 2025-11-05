<?php

namespace Dreamscape\ResellerApiSdk\PredefinedValue\Product;

/**
 * Predefined values for SSL Certificate product.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class SslCertificate
{
    #region Hosted with

    public const HOSTED_WITH_DREAMSCAPE = 'dreamscape';
    public const HOSTED_WITH_EXTERNAL = 'external';

    #endregion

    #region Account types

    public const ACCOUNT_TYPE_PERSONAL = 'personal';
    public const ACCOUNT_TYPE_BUSINESS = 'business';

    #endregion

    #region DCV methods

    public const DCV_METHOD_EMAIL = 'email';
    public const DCV_METHOD_HTTP = 'http';
    public const DCV_METHOD_CNAME = 'cname';

    #endregion
}

<?php

namespace Dreamscape\ResellerApiSdk\PredefinedValue\Domain;

/**
 * Predefined values for DNS records.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class DNS
{
    public const A = 'A';
    public const AAAA = 'AAAA';
    public const CAA = 'CAA';
    public const CNAME = 'CNAME';
    public const MX = 'MX';
    public const SRV = 'SRV';
    public const TXT = 'TXT';
    public const MAILFWD = 'MAILFWD';
    public const WEBFWD = 'WEBFWD';

    public const CAA_FLAG_VALUES = [ 0, 128 ];
    public const CAA_TAG_VALUES = [ 'issue', 'issuewild' ];
}

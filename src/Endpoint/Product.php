<?php

namespace Dreamscape\ResellerApiSdk\Endpoint;

/**
 * SDK API for working with products.
 *
 * @property-read Product\Type $types
 * @property-read Product\Plan $plans
 * @property-read Product\LinuxHosting $linuxHostings
 * @property-read Product\WindowsHosting $windowsHostings
 * @property-read Product\EmailHosting $emailHostings
 * @property-read Product\WordPressHosting $wordpressHostings
 * @property-read Product\EmailExchange $emailExchanges
 * @property-read Product\DnsHosting $dnsHostings
 * @property-read Product\Servers $servers
 * @property-read Product\WhmHosting $whmHostings
 * @property-read Product\SslCertificate $sslCertificates
 * @property-read Product\SiteBuilder $siteBuilders
 * @property-read Product\TrafficBooster $trafficBoosters
 * @property-read Product\SiteProtection $siteProtections
 * @property-read Product\EmailProtection $emailProtections
 * @property-read Product\EmailMarketing $emailMarketings
 * @property-read Product\FaxToEmail $faxToEmails
 * @property-read Product\WebAnalytics $webAnalytics
 * @property-read Product\BusinessDirectory $businessDirectories
 * @property-read Product\SimpleSeo $simpleSeos
 * @property-read Product\CloudBackup $cloudBackups
 * @property-read Product\Package $packages
 * @property-read Product\DomainPrivacy $domainPrivacies
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Product extends AbstractEndpoint
{
    /**
     * @inheritDoc
     */
    protected array $endpoint_to_class_map = [
        'types' => Product\Type::class,
        'plans' => Product\Plan::class,
        'linuxhostings' => Product\LinuxHosting::class,
        'windowshostings' => Product\WindowsHosting::class,
        'emailhostings' => Product\EmailHosting::class,
        'wordpresshostings' => Product\WordPressHosting::class,
        'emailexchanges' => Product\EmailExchange::class,
        'dnshostings' => Product\DnsHosting::class,
        'servers' => Product\Servers::class,
        'whmhostings' => Product\WhmHosting::class,
        'sslcertificates' => Product\SslCertificate::class,
        'sitebuilders' => Product\SiteBuilder::class,
        'trafficboosters' => Product\TrafficBooster::class,
        'siteprotections' => Product\SiteProtection::class,
        'emailprotections' => Product\EmailProtection::class,
        'emailmarketings' => Product\EmailMarketing::class,
        'faxtoemails' => Product\FaxToEmail::class,
        'webanalytics' => Product\WebAnalytics::class,
        'businessdirectories' => Product\BusinessDirectory::class,
        'simpleseos' => Product\SimpleSeo::class,
        'cloudbackups' => Product\CloudBackup::class,
        'packages' => Product\Package::class,
        'domainprivacies' => Product\DomainPrivacy::class,
    ];
}

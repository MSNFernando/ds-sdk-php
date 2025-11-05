<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\SslCertificate;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;

/**
 * @property string $commonName
 * @property string $organization
 * @property string $organizationUnit
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $email
 * @property string $jurisdictionCountry
 * @property string $csr
 * @property int $serverSoftware
 * @property bool $isCertificateFileExist
 * @property bool $isReissueAvailable
 * @property bool $isAutoDcvSupported
 *
 * @method $this setCommonName(string $commonName)
 * @method $this setOrganization(string $organization)
 * @method $this setOrganizationUnit(string $organizationUnit)
 * @method $this setCountry(string $country)
 * @method $this setState(string $state)
 * @method $this setCity(string $city)
 * @method $this setEmail(string $email)
 * @method $this setJurisdictionCountry(string $jurisdictionCountry)
 * @method $this setCsr(string $csr)
 * @method $this setServerSoftware(int $serverSoftware)
 * @method $this setIsCertificateFileExist(bool $isCertificateFileExist)
 * @method $this setIsReissueAvailable(bool $isReissueAvailable)
 * @method $this setIsAutoDcvSupported(bool $isAutoDcvSupported)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class CertificateDetails extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(
                Structure\Property::build('commonName', 'common_name')
                    ->type(Structure\DataType::STRING)
            )
            ->addProperty(
                Structure\Property::build('organization')
                    ->type(Structure\DataType::STRING)
            )
            ->addProperty(
                Structure\Property::build('organizationUnit', 'organization_unit')
                    ->type(Structure\DataType::STRING)
            )
            ->addProperty(
                Structure\Property::build('country')
                    ->type(Structure\DataType::STRING)
            )
            ->addProperty(
                Structure\Property::build('state')
                    ->type(Structure\DataType::STRING)
            )
            ->addProperty(
                Structure\Property::build('city')
                    ->type(Structure\DataType::STRING)
            )
            ->addProperty(
                Structure\Property::build('email')
                    ->type(Structure\DataType::STRING)
            )
            ->addProperty(
                Structure\Property::build('jurisdictionCountry', 'jurisdiction_country')
                    ->type(Structure\DataType::STRING)
            )
            ->addProperty(
                Structure\Property::build('csr')
                    ->type(Structure\DataType::STRING)
            )
            ->addProperty(
                Structure\Property::build('serverSoftware', 'server_software')
                    ->type(Structure\DataType::INTEGER)
            )
            ->addProperty(
                Structure\Property::build('isCertificateFileExist', 'is_certificate_file_exist')
                    ->type(Structure\DataType::BOOL)
            )
            ->addProperty(
                Structure\Property::build('isReissueAvailable', 'is_reissue_available')
                    ->type(Structure\DataType::BOOL)
            )
            ->addProperty(
                Structure\Property::build('isAutoDcvSupported', 'is_auto_dcv_supported')
                    ->type(Structure\DataType::BOOL)
            )
            ;
    }
}

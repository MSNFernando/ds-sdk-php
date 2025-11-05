<?php

namespace Dreamscape\ResellerApiSdk\Endpoint\Product;

use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\Exception\NotFoundException;
use Dreamscape\ResellerApiSdk\Exception\PaymentRequiredException;
use Dreamscape\ResellerApiSdk\Filter;
use Dreamscape\ResellerApiSdk\Endpoint\AbstractEndpoint;
use Dreamscape\ResellerApiSdk\Exception\AuthenticationException;
use Dreamscape\ResellerApiSdk\Exception\BadRequestException;
use InvalidArgumentException;

/**
 * SDK API for working with SSL Certificate products.
 *
 * @title SSL Certificate Product API
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class SslCertificate extends AbstractEndpoint
{
    /**
     * Returns the list of existing SSL Certificate products.
     *
     * @param Filter\Product\SslCertificate\GetAll|null $filters
     *
     * @return DataObject\Product\SslCertificate\Existing[]|DataObject\Collection
     * @throws AuthenticationException
     * @throws BadRequestException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\Filter;
     * use Dreamscape\ResellerApiSdk\Exception;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * $filters = Filter\Product\SslCertificate\GetAll::build();
     *
     * $filters->customerId = 123456;
     * $filters->statusId = 1;
     * $filters->limit = 10;
     * $filters->page = 1;
     *
     * try {
     *      $products = $api->products->sslCertificates->getAll($filters);
     *
     *      foreach ($products as $product) {
     *          echo 'Product ID: ' . $product->id . PHP_EOL;
     *          echo 'Domain Name: ' . $product->domainName . PHP_EOL;
     *      }
     *
     *      echo 'Total items: ' . $products->totalItems . PHP_EOL;
     *      echo 'Total pages: ' . $products->totalPages . PHP_EOL;
     *      echo 'Current page: ' . $products->currentPage . PHP_EOL;
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * }
     */
    public function getAll(Filter\Product\SslCertificate\GetAll $filters = null): DataObject\Collection
    {
        return DataObject\Helper::convertResponseToDataObjectCollection(
            $this->sendGetRequest('products/ssl-certificates', $filters ? $filters->toRequestArray() : []),
            DataObject\Product\SslCertificate\Existing::class
        );
    }

    /**
     * Returns the details about single SSL Certificate product.
     *
     * @param int $product_id
     *
     * @return DataObject\Product\SslCertificate\Existing
     * @throws AuthenticationException
     * @throws NotFoundException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\Exception;
     * use Dreamscape\ResellerApiSdk\PredefinedValue;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * try {
     *      $product = $api->products->sslCertificates->getDetails(123456);
     *
     *      echo 'Product ID: ' . $product->id . PHP_EOL;
     *      echo 'Domain Name: ' . $product->domainName . PHP_EOL;
     *
     *      if ($product->statusId === PredefinedValue\Product::STATUS_REGISTERED) {
     *          echo 'Product is registered' . PHP_EOL;
     *      }
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function getDetails(int $product_id): DataObject\Product\SslCertificate\Existing
    {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendGetRequest('products/ssl-certificates/' . $product_id),
            DataObject\Product\SslCertificate\Existing::class
        );
    }

    /**
     * Registers new SSL Certificate product.
     *
     * @param DataObject\Product\SslCertificate\Register $data_object
     *
     * @return DataObject\Product\SslCertificate\Existing
     * @throws AuthenticationException
     * @throws BadRequestException
     * @throws PaymentRequiredException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\DataObject;
     * use Dreamscape\ResellerApiSdk\Exception;
     * use Dreamscape\ResellerApiSdk\PredefinedValue;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * $new_product = DataObject\Product\SslCertificate\Register::build()
     *      ->setCustomerId(123456)
     *      ->setDomainName('crazydomains.com.au')
     *      ->setPlanId(65)
     *      ->setPeriod(12)
     *      ->setHostedWith(PredefinedValue\Product\SslCertificate::HOSTED_WITH_EXTERNAL)
     *      ->setCsr('-----BEGIN CERTIFICATE REQUEST----- ... -----END CERTIFICATE REQUEST-----')
     *      ->setServerSoftware(1)
     *      ->setAutoFillDetails(true);
     *
     * try {
     *      $product = $api->products->sslCertificates->register($new_product);
     *
     *      echo 'Product ID: ' . $product->id;
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * } catch (Exception\PaymentRequiredException $e) {
     *      // Handle the exception.
     * }
     */
    public function register(
        DataObject\Product\SslCertificate\Register $data_object
    ): DataObject\Product\SslCertificate\Existing {
        return DataObject\Helper::convertResponseToDataObject(
            $this->sendPostRequest('products/ssl-certificates', $data_object->toRequestArray()),
            DataObject\Product\SslCertificate\Existing::class
        );
    }

    /**
     * Returns the certificate details of SSL Certificate product.
     *
     * @param int $product_id
     *
     * @return DataObject\Product\SslCertificate\CertificateDetails
     * @throws AuthenticationException
     * @throws NotFoundException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\Exception;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * try {
     *      $certificateDetails = $api->products->sslCertificates->getCertificateDetails(123456);
     *
     *      echo 'Common Name: ' . $certificateDetails->commonName . PHP_EOL;
     *      echo 'Organization: ' . $certificateDetails->organization . PHP_EOL;
     *      echo 'CSR: ' . $certificateDetails->csr . PHP_EOL;
     *      echo 'Server software ID: ' . $certificateDetails->serverSoftware . PHP_EOL;
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function getCertificateDetails(int $product_id): DataObject\Product\SslCertificate\CertificateDetails
    {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendGetRequest('products/ssl-certificates/' . $product_id . '/details'),
            DataObject\Product\SslCertificate\CertificateDetails::class
        );
    }

    /**
     * Process the reissue of SSL Certificate with automated generation of CSR-code.
     *
     * @param int $product_id
     * @param DataObject\Product\SslCertificate\Reissue\Auto $data_object
     *
     * @return DataObject\Product\SslCertificate\CertificateDetails
     * @throws AuthenticationException
     * @throws NotFoundException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\Exception;
     * use Dreamscape\ResellerApiSdk\DataObject;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * try {
     *      $reissue = DataObject\Product\SslCertificate\Reissue\Auto::build();
     *      $reissue->commonName = 'crazydomains.com';
     *      $reissue->organization = 'Crazy Domains';
     *      $reissue->organizationUnit = 'IT';
     *      $reissue->country = 'AU';
     *      $reissue->state = 'NSW';
     *      $reissue->city = 'Sydney';
     *      $reissue->email = 'admin@crazydomains.com';
     *      $reissue->serverSoftware = 1;
     *
     *      $api->products->sslCertificates->reissueAuto(123456, $reissue);
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function reissueAuto(
        int $product_id,
        DataObject\Product\SslCertificate\Reissue\Auto $data_object
    ): DataObject\Product\SslCertificate\CertificateDetails {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendPostRequest(
                'products/ssl-certificates/' . $product_id . '/reissue/auto',
                $data_object->toRequestArray()
            ),
            DataObject\Product\SslCertificate\CertificateDetails::class
        );
    }

    /**
     * Process the reissue of SSL Certificate with manually generated CSR-code.
     *
     * @param int $product_id
     * @param DataObject\Product\SslCertificate\Reissue\Manual $data_object
     *
     * @return DataObject\Product\SslCertificate\CertificateDetails
     * @throws AuthenticationException
     * @throws NotFoundException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\Exception;
     * use Dreamscape\ResellerApiSdk\DataObject;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * try {
     *      $reissue = DataObject\Product\SslCertificate\Reissue\Manual::build();
     *      $reissue->csr = '-----BEGIN CERTIFICATE REQUEST----- ... -----END CERTIFICATE REQUEST-----';
     *      $reissue->serverSoftware = 1;
     *
     *      $api->products->sslCertificates->reissueManual(123456, $reissue);
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function reissueManual(
        int $product_id,
        DataObject\Product\SslCertificate\Reissue\Manual $data_object
    ): DataObject\Product\SslCertificate\CertificateDetails {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendPostRequest(
                'products/ssl-certificates/' . $product_id . '/reissue/manual',
                $data_object->toRequestArray()
            ),
            DataObject\Product\SslCertificate\CertificateDetails::class
        );
    }

    /**
     * Process the reissue of SSL Certificate with manually generated CSR-code.
     *
     * @param int $product_id
     *
     * @return DataObject\Product\SslCertificate\File
     * @throws AuthenticationException
     * @throws NotFoundException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\Exception;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * try {
     *      $file = $api->products->sslCertificates->getFile(123456);
     *
     *      file_put_contents($file->name, $file->content);
     *
     *      echo 'File saved to ' . $file->name . PHP_EOL;
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function getFile(int $product_id): DataObject\Product\SslCertificate\File
    {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        $file = DataObject\Helper::convertResponseToDataObject(
            $this->sendGetRequest('products/ssl-certificates/' . $product_id . '/file'),
            DataObject\Product\SslCertificate\File::class
        );
        $file->content = base64_decode($file->content);

        return $file;
    }

    /**
     * Returns the DCV details of SSL Certificate product.
     *
     * @param int $product_id
     *
     * @return DataObject\Product\SslCertificate\Dcv
     * @throws AuthenticationException
     * @throws NotFoundException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\Exception;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * try {
     *      $dcv = $api->products->sslCertificates->getDcv(123456);
     *
     *      echo 'Method: ' . $dcv->method . PHP_EOL;
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function getDcv(int $product_id): DataObject\Product\SslCertificate\Dcv
    {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendGetRequest('products/ssl-certificates/' . $product_id . '/dcv'),
            DataObject\Product\SslCertificate\Dcv::class
        );
    }

    /**
     * Updates the DCV details of SSL Certificate product.
     *
     * @param int $product_id
     * @param DataObject\Product\SslCertificate\Dcv\Update $data_object
     *
     * @return DataObject\Product\SslCertificate\Dcv
     * @throws AuthenticationException
     * @throws NotFoundException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\Exception;
     * use Dreamscape\ResellerApiSdk\PredefinedValue;
     * use Dreamscape\ResellerApiSdk\DataObject;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * try {
     *      $new_dcv = DataObject\Product\SslCertificate\Dcv\Update::build();
     *      $new_dcv->method = PredefinedValue\Product\SslCertificate::DCV_METHOD_EMAIL;
     *      $new_dcv->email = 'postmaster@crazydomains.com';
     *      $dcv = $api->products->sslCertificates->updateDcv(123456, $new_dcv);
     *
     *      echo 'New method: ' . $dcv->method . PHP_EOL;
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function updateDcv(
        int $product_id,
        DataObject\Product\SslCertificate\Dcv\Update $data_object
    ): DataObject\Product\SslCertificate\Dcv {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendPatchRequest(
                'products/ssl-certificates/' . $product_id . '/dcv',
                $data_object->toRequestArray()
            ),
            DataObject\Product\SslCertificate\Dcv::class
        );
    }

    /**
     * Returns the DCV HTTP details of SSL Certificate product.
     *
     * @param int $product_id
     *
     * @return DataObject\Product\SslCertificate\Dcv\Http
     * @throws AuthenticationException
     * @throws NotFoundException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\Exception;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * try {
     *      $dcvHttp = $api->products->sslCertificates->getDcvHttp(123456);
     *
     *      echo 'Name: ' . $dcvHttp->name . PHP_EOL;
     *      echo 'Path: ' . $dcvHttp->path . PHP_EOL;
     *      echo 'URL: ' . $dcvHttp->url . PHP_EOL;
     *      echo 'Content: ' . $dcvHttp->content . PHP_EOL;
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function getDcvHttp(int $product_id): DataObject\Product\SslCertificate\Dcv\Http
    {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendGetRequest('products/ssl-certificates/' . $product_id . '/dcv/http'),
            DataObject\Product\SslCertificate\Dcv\Http::class
        );
    }

    /**
     * Returns the DCV CNAME details of SSL Certificate product.
     *
     * @param int $product_id
     *
     * @return DataObject\Product\SslCertificate\Dcv\Cname
     * @throws AuthenticationException
     * @throws NotFoundException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\Exception;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * try {
     *      $dcvCname = $api->products->sslCertificates->getDcvCname(123456);
     *
     *      echo 'Name: ' . $dcvCname->name . PHP_EOL;
     *      echo 'Value: ' . $dcvCname->value . PHP_EOL;
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function getDcvCname(int $product_id): DataObject\Product\SslCertificate\Dcv\Cname
    {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendGetRequest('products/ssl-certificates/' . $product_id . '/dcv/cname'),
            DataObject\Product\SslCertificate\Dcv\Cname::class
        );
    }

    /**
     * Returns the DCV EMAIL details of SSL Certificate product.
     *
     * @param int $product_id
     *
     * @return DataObject\Product\SslCertificate\Dcv\Email
     * @throws AuthenticationException
     * @throws NotFoundException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\Exception;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * try {
     *      $dcvEmail = $api->products->sslCertificates->getDcvEmail(123456);
     *
     *      echo 'Emails: ' . implode(', ', $dcvEmail->emails) . PHP_EOL;
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function getDcvEmail(int $product_id): DataObject\Product\SslCertificate\Dcv\Email
    {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendGetRequest('products/ssl-certificates/' . $product_id . '/dcv/email'),
            DataObject\Product\SslCertificate\Dcv\Email::class
        );
    }

    /**
     * Renews SSL Certificate product.
     *
     * @param int $product_id
     * @param DataObject\Product\SslCertificate\Renew|null $data_object
     *
     * @return DataObject\Product\SslCertificate\Existing
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws BadRequestException
     * @throws PaymentRequiredException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\DataObject;
     * use Dreamscape\ResellerApiSdk\Exception;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * $renew_product = DataObject\Product\SslCertificate\Renew::build();
     * $renew_product->period = 24;
     *
     * try {
     *      $product = $api->products->sslCertificates->renew(123456, $renew_product);
     *
     *      echo 'Product ID: ' . $product->id;
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * } catch (Exception\PaymentRequiredException $e) {
     *      // Handle the exception.
     * }
     */
    public function renew(
        int $product_id,
        DataObject\Product\SslCertificate\Renew $data_object = null
    ): DataObject\Product\SslCertificate\Existing {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendPostRequest(
                'products/ssl-certificates/' . $product_id . '/renewal',
                $data_object ? $data_object->toRequestArray() : []
            ),
            DataObject\Product\SslCertificate\Existing::class
        );
    }

    /**
     * Terminates SSL Certificate product.
     *
     * @param int $product_id
     *
     * @return bool
     * @throws AuthenticationException
     * @throws NotFoundException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\Exception;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * try {
     *      $api->products->sslCertificates->terminate(123456);
     *
     *      echo 'Product successfully terminated';
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function terminate(int $product_id): bool
    {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return $this->sendDeleteRequest('products/ssl-certificates/' . $product_id);
    }
}

<?php

declare(strict_types=1);

namespace Auth0\JWTAuthBundle;

use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\API\Helpers\InformationHeaders;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\Kernel;

/**
 * A simple JWT Authentication Bundle for Symfony REST APIs.
 *
 * @package Auth0\JWTAuthBundle
 */
class JWTAuthBundle extends Bundle
{
    public const SDK_VERSION = '5.0.0';

    /**
     * JWTAuthBundle constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $oldInfoHeaders = ApiClient::getInfoHeadersData();

        if ($oldInfoHeaders !== null) {
            $infoHeaders = InformationHeaders::Extend($oldInfoHeaders);

            $infoHeaders->setEnvProperty('Symfony', Kernel::VERSION);
            $infoHeaders->setPackage('jwt-auth-bundle', self::SDK_VERSION);

            ApiClient::setInfoHeadersData($infoHeaders);
        }
    }

    /**
     * Returns an alias for the JWTAuthBundle
     */
    public function getAlias(): string
    {
        return 'jwt_auth';
    }
}

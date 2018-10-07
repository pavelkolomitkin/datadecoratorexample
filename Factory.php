<?php

namespace data;

use data\exception\FactoryException;
use data\lib\Cache;
use data\lib\Logger;
use data\Provider\AbstractProvider;
use data\Provider\CacheProviderDecorator;
use data\Provider\ConnectionConfig;
use data\Provider\DataBaseDataProvider;
use data\Provider\ExternalServiceDataProvider;
use data\Provider\LoggerProviderDecorator;

class Factory
{
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function createProvider(): AbstractProvider
    {
        $result = null;
        $serviceType = $this->config['service_type'];
        $serviceConfig = $this->config['service_config'];

        switch ($serviceType)
        {
            case 'database':

                $result = new DataBaseDataProvider(new ConnectionConfig($serviceConfig));

                break;

            case 'external_service':
                $result = new ExternalServiceDataProvider(new ConnectionConfig($serviceConfig));

                break;

            default:

                throw new FactoryException('Cannot to create service with type "' . $serviceType . '"');
        }


        if ($this->config['cache'])
        {
            $result = new CacheProviderDecorator($result, new Cache());
        }

        if ($this->config['log'])
        {
            $result = new LoggerProviderDecorator($result, new Logger());
        }


        return $result;
    }
}
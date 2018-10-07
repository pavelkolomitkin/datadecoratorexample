<?php

namespace data\Provider;


use data\exception\Exception;
use data\lib\Logger;

class LoggerProviderDecorator extends ProviderDecorator
{
    /**
     * @var \Logger
     */
    private $logger;

    public function __construct(AbstractProvider $provider, Logger $logger)
    {
        parent::__construct($provider);
        $this->logger = $logger;
    }

    public function get(DataRequest $request)
    {
        $this->logger->log('Some log');
        try
        {
            $result = $this->provider->get($request);
            // Do something to log data
            return $result;
        }
        catch (Exception $exception)
        {
            $this->logger->log($exception->getMessage());
            throw $exception;
        }
    }
}
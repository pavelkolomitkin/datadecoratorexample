<?php

namespace data\Provider;

abstract class DataProvider extends AbstractProvider
{
    /**
     * @var ConnectionConfig
     */
    protected $config;

    public function __construct(ConnectionConfig $config)
    {
        $this->config = $config;
        $this->connect();
    }

    abstract protected function connect();
}
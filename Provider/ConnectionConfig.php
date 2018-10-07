<?php

namespace data\Provider;

use data\exception\ConfigException;

class ConnectionConfig
{
    private $params;

    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    /**
     * @param $name
     * @return mixed
     * @throws ConfigException
     */
    public function __get($name)
    {
        if (!isset($this->params[$name]))
        {
            throw new ConfigException('Cannot find connection parameter "' . $name . '"!');
        }

        return $this->params[$name];
    }

    public function __set($name, $value)
    {
        $this->params[$name] = $value;
    }
}
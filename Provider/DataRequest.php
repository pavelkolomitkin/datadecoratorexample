<?php

namespace data\Provider;

use data\exception\RequestParamException;

class DataRequest
{
    protected $params;

    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    /**
     * @param $name
     * @return mixed
     * @throws RequestParamException
     */
    public function __get($name)
    {
        if (!isset($this->params[$name]))
        {
            throw new RequestParamException('Request parameter "' . $name . '" does not exist!');
        }

        return $this->params[$name];
    }

    public function __set($name, $value)
    {
        $this->params[$name] = $value;
    }

    public function getAll()
    {
        return $this->params;
    }
}
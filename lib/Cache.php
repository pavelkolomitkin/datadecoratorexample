<?php

namespace data\lib;

class Cache
{
    const EXPIRED_KEY = 'expired';

    const DATA_KEY = 'data';

    const DEFAULT_EXPIRED_TIME = '+1 day';

    private $config;

    // this is just mock, not real storage
    private $data;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function getData($key)
    {
        if (!is_array($this->data[$key]))
        {
            return null;
        }

        $data = $this->data[$key];
        if (!($data[self::EXPIRED_KEY] instanceof \DateTime))
        {
            unset($this->data[$key]);
            return null;
        }

        $expired = $data[self::EXPIRED_KEY];
        if ($expired->getTimestamp() >= time())
        {
            unset($this->data[$key]);
            return null;
        }

        return $data[$key][self::DATA_KEY];
    }

    public function setData($key, $data)
    {
        $ttl = !empty($this->config[self::EXPIRED_KEY]) ?
            $this->config[self::EXPIRED_KEY] : self::DEFAULT_EXPIRED_TIME;

        $expiredTime = new \DateTime();
        $expiredTime->modify($ttl);

        $item = [
            self::DATA_KEY => $data,
            self::EXPIRED_KEY => $expiredTime
        ];

        $this->data[$key] = $item;

        return $this;
    }
}
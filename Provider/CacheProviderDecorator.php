<?php

namespace data\Provider;

use data\lib\Cache;

class CacheProviderDecorator extends ProviderDecorator
{
    /**
     * @var \Cache
     */
    private $cache;

    public function __construct(AbstractProvider $provider, Cache $cache)
    {
        parent::__construct($provider);
        $this->cache = $cache;
    }


    public function get(DataRequest $request)
    {
        $cacheKey = $this->getCacheKeyByRequest($request);
        $result = $this->cache->getData($cacheKey);
        if ($result !== null)
        {
            return $result;
        }

        $result = $this->provider->get($request);
        if ($result !== null)
        {
            $this->cache->setData($cacheKey, $result);
        }

        return $result;
    }

    private function getCacheKeyByRequest(DataRequest $request)
    {
        return json_encode($request->getAll());
    }
}
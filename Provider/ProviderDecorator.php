<?php

namespace data\Provider;

abstract class ProviderDecorator extends AbstractProvider
{
    /**
     * @var AbstractProvider
     */
    protected $provider;

    public function __construct(AbstractProvider $provider)
    {
        $this->provider = $provider;
    }
}
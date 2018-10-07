<?php

namespace data\Provider;

abstract class AbstractProvider
{
    public abstract function get(DataRequest $request);
}
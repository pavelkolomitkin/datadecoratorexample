<?php

namespace data\Provider;

class ExternalServiceDataProvider extends DataProvider
{
    public function get(DataRequest $request)
    {
        // get data from external service by request
        $result = []; // any data from external service

        return $result;
    }

    protected function connect()
    {
        // use $this->config and your own algorithm to connect to external service
    }
}
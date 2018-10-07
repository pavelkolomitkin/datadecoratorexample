<?php

namespace data\Provider;

class DataBaseDataProvider extends DataProvider
{
    public function get(DataRequest $request)
    {
        // get data from database by request parameters
        $result = []; // any data from DB

        return $result;
    }

    protected function connect()
    {
        // use $this->config and your own algorithm to connect to database
    }
}
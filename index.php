<?php

require_once(__DIR__ . '/vendor/autoload.php');

$config = [
    'service_type' => 'external_service',
    'service_config' => [
        // params
    ],
    'cache' => true,
    'log' => true
];

$factory = new \data\Factory($config);

try
{
    $provider = $factory->createProvider();
    $data = $provider->get(new \data\Provider\DataRequest([
        // any params
    ]));
    var_dump($data);
}
catch (Exception $exception)
{
    print $exception->getMessage();
}
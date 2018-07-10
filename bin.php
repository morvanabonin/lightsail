<?php
/**
 * Test call class LightSail
 */
require 'vendor/autoload.php';
$config = require 'config/app.config.php';

use LightSail\LightSailProvider;

$lightsail = new LightSailProvider($config);
//print_r($lightsail->getInstances());
//print_r($lightsail->startInstance());
// $lightsail->deleteInstances();
/*$lightsail->getDataInstace();
$lightsail->getInstance();*/
//print_r($lightsail->stopInstance());

$startTime = new DateTime();
print_r($lightsail->getInstanceMetrics([
    'endTime' => new DateTime(),
    'instanceName' => 'deathnote',
    'metricName' => 'CPUUtilization',
    'period' => 60,
    'startTime' => $startTime->modify('-1 day'),
    'statistics' => "Average",
    'unit' => 'Percent'
]));

//print_r($lightsail->getBlueprints());

//print_r($lightsail->getRegions());

$name = 'vps-test-'. rand();

$lightsail->createInstance([
    'availabilityZone' => 'us-east-2a',
    'blueprintId' => 'ubuntu_16_04_2',
    'bundleId' => 'nano_1_0',
    'customImageName' => null,
    'instanceNames' => [ $name ],
    'customImageName' => null,
    'keyPairName' => null,
    'userData' => ''
]);


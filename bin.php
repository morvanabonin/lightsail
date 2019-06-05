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
/*print_r($lightsail->getInstanceMetrics([
    'endTime' => new DateTime(),
    'instanceName' => 'deathnote',
    'metricName' => 'CPUUtilization',
    'period' => 60,
    'startTime' => $startTime->modify('-1 day'),
    'statistics' => "Average",
    'unit' => 'Percent'
]));*/

//print_r($lightsail->getBlueprints());
print_r($lightsail->deleteInstance("testeDocker"));
//print_r($lightsail->getRegions());

$name = 'vps-test-'. rand();

/*print_r($lightsail->createInstance([
    'availabilityZone' => 'us-east-2a',
    'blueprintId' => 'ubuntu_16_04_2',
    'bundleId' => 'nano_1_0',
    'customImageName' => "teste",
    'instanceNames' => [ $name ],
    'keyPairName' => null,
    'userData' => 'apt-get updade ; curl -fsSL https://get.docker.com | sh ; docker volume create portainer_data; docker run -d -p 9000:9000 -v /var/run/docker.sock:/var/run/docker.sock -v portainer_data:/data portainer/portainer'
]));*/

/*print_r($lightsail->openInstancePublicPorts([
    'instanceName' => 'testeDocker',
    'fromPort' => 9000,
    'protocol' => 'TCP',
    'toPort' => 9000
]));*/



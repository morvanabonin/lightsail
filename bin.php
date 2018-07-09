<?php
/**
 * Test call class LightSail
 */
require 'vendor/autoload.php';

use LightSail\LightSailProvider;

$lightsail = new LightSailProvider();
//print_r($lightsail->getInstances());
print_r($lightsail->startInstance());
/*$lightsail->getDataInstace();
$lightsail->getInstance();*/
//echo $lightsail->startInstance();
//print_r($lightsail->getBundles());

//print_r($lightsail->getBlueprints());

//print_r($lightsail->getRegions());

/*$lightsail->createInstance([
    'availabilityZone' => 'us-east-2a',
    'blueprintId' => 'ubuntu_16_04_2',
    'bundleId' => 'nano_1_0',
    'customImageName' => null,
    'instanceNames' => ["deathNote2"],
    'customImageName' => null,
    'userData' => 'apt-get upgrade'
]);*/


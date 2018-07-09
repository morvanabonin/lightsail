<?php
/**
 * Test call class LightSail
 */
require 'vendor/autoload.php';

use LightSail\LightSailProvider;

$lightsail = new LightSailProvider();
print_r($lightsail->stopInstance());
/*$lightsail->getDataInstace();
$lightsail->getInstance();*/
//echo $lightsail->startInstance();

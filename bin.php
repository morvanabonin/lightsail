<?php
/**
 * Test call class LightSail
 */
require 'vendor/autoload.php';

use LightSail\LightSailProvider;

$lightsail = new LightSailProvider();
$lightsail->getInstances();
$lightsail->getDataInstace();
echo $lightsail->getInstance();

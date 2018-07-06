<?php
/**
 * Test call class LightSail
 */
require 'vendor/autoload.php';

use LightSail\LightSailProvider;

$lightsail = new LightSailProvider();
echo $lightsail->getInstances();
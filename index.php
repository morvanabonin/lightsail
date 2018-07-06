<?php

require_once ('vendor/autoload.php');

$client = new \Aws\AwsClient(["service" => 'lightsail']);
print_r($client);
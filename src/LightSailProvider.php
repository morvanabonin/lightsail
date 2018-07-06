<?php
/**
 * Class API to connect the Lightsail
 */

namespace LightSail;

use Aws\Credentials\Credentials;
use Aws\Lightsail\LightsailClient;


class LightSailProvider
{

    const KEY = '';
    const SECRET = '';
    public $credentials;
    public $lightSailClient;

    /**
     * LightSail constructor
     */
    public function __construct()
    {
        $this->credentials = new Credentials(self::KEY, self::SECRET);
        $this->lightSailClient = new LightsailClient([
            "region" => 'us-east-2',
            "version" => "latest",
            "credentials" => $this->credentials
        ]);
    }

    /**
     * Get Instances of user
     */
    public function getInstances() {
        return $this->lightSailClient->getInstances();
    }

    public function startInstance($instance)
    {
        return $this->lightSailClient->startInstance(["instanceName" => $instance]);
    }

    public function stopInstance($instance, $force = false)
    {
        return $this->lightSailClient->stopInstance([
            "force" => $force,
            "instanceName" => $instance
        ]);
    }

    public function getBlueprints()
    {
        return $this->lightSailClient->getBlueprints();
    }

    public function getBundles()
    {
        return $this->lightSailClient->getBundles();
    }

    public function getRegions()
    {
        return $this->lightSailClient->getRegions([
            'includeAvailabilityZones' => true
        ]);
    }

    public function createInstance($params)
    {
        return $this->lightSailClient->createInstances([
            'availabilityZone' => $params['availabilityZone'],
            'blueprintId' => $params['blueprintId'],
            'bundleId' => $params['bundleId'],
            'customImageName' => $params[''],
            'instanceNames' => $params['instanceNames'],
            'keyPairName' => $params['keyPairName'],
            'userData' => $params['userData']
        ]);
    }
}
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
        $this->lightSailClient = new LightsailClient([ "region" => 'us-east-2', "version" => "latest", 'credentials' => $this->credentials]);
    }

    /**
     * Get Instances of user
     */
    public function getInstances() {
        return $this->lightSailClient->getInstances();
    }


}
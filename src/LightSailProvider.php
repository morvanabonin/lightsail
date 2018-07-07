<?php
/**
 * Class API to connect the Lightsail
 */

namespace LightSail;

use Aws\Credentials\Credentials;
use Aws\Lightsail\LightsailClient;


class LightSailProvider
{

    const KEY = 'AKIAIKACIJXGZJJIDDBA';
    const SECRET = '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';
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
     * Get all Instances of user
     * Returns information about all Amazon Lightsail virtual private servers, or instances.
     * @return \Aws\Result
     */
    public function getInstances() {
        try {
            return $this->lightSailClient->getInstances();
        } catch (\Exception $e) {
            echo "Erro ao acessar a Amazon Lightsail API. Messagem {$e->getMessage()}" . PHP_EOL;
        }

    }

    /**
     * Returns informations about all Amazon Lightsail instances.
     * @return array $ret
     */
    public function getDataInstace() {
        $ret = array();
        $instances = $this->lightSailClient->getInstances()["instances"];
        foreach ($instances as $instance) {
            $ret = $instance;
        }
        return $ret;
    }

    /**
     * Gets a specific instance
     * Returns information about a specific Amazon Lightsail instance, which is a virtual private server.
     *
     */
    public function getInstance() {
        $name = $this->getDataInstace()["name"];
        return $this->lightSailClient->getInstance(['instanceName' => $name]);
    }

    /**
     * Returns a name of instance
     */
    public function getInstanceName() {
        return $this->getDataInstace()["name"];
    }

    /**
     * Start a stopped Instance
     */
    public function startInstance() {
        $result = $this->lightSailClient->startInstance(['instanceName' =>  $this->getInstanceName()]);
        var_dump($result);
        exit;
    }

    /**
     * Stop a started Instance
     */
    public function stopInstance() {

    }

}
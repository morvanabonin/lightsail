<?php
/**
 * Class API to connect the Lightsail
 */

namespace LightSail;


use Aws\Credentials\Credentials;
use Aws\Lightsail\LightsailClient;

class LightSailProvider
{

    public $credentials;
    public $lightSailClient;

    /**
     * LightSail constructor
     * @param $config
     */
    public function __construct($config)
    {
        $key = $this->_getKey($config);
        $secret = $this->_getSecret($config);

        $this->credentials = new Credentials($key, $secret);
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
            echo "Erro ao acessar a Amazon Lightsail API. " . PHP_EOL ."Messagem {$e->getMessage()}" . PHP_EOL;
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
        try {
            $result = $this->lightSailClient->startInstance(['instanceName' =>  $this->getInstanceName()]);
        } catch (\Exception $e) {
            echo "Não foi possivel iniciar a instancia da Amazon Lightsail API." . PHP_EOL ."Messagem {$e->getMessage()}";
        }
    }

    /**
     * Stop a started Instance
     */
    public function stopInstance() {
        return $this->lightSailClient->stopInstance(['instanceName' =>  $this->getInstanceName()]);
    }

    /**\
     * Get availables blueprints
     * @return \Aws\Result
     */
    public function getBlueprints()
    {
        return $this->lightSailClient->getBlueprints();
    }

    /**
     * Get availables bundles
     * @return \Aws\Result
     */
    public function getBundles()
    {
        return $this->lightSailClient->getBundles();
    }

    /**
     * Return regions with yours availability zones
     * @return \Aws\Result
     */
    public function getRegions()
    {
        return $this->lightSailClient->getRegions([
            'includeAvailabilityZones' => true
        ]);
    }

    /**
     * Create news instances
     * @param $params
     * @return \Aws\Result
     */
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

    private function _getKey($config) {
        return $config['credentials']['access_key_ID'];
    }

    private function _getSecret($config) {
        return $config['credentials']['secret_access_key'];
    }
}
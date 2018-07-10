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
        $this->lightSailClient = new LightsailClient(["region" => 'us-east-2', "version" => "latest", 'credentials' => $this->credentials]);
    }

    /**
     * Get all Instances of user
     * Returns information about all Amazon Lightsail virtual private servers, or instances.
     * @return \Aws\Result
     */
    public function getInstances()
    {
        try {
            return $this->lightSailClient->getInstances();
        } catch (\Exception $e) {
            echo "Erro ao acessar a Amazon Lightsail API. " . PHP_EOL . "Messagem {$e->getMessage()}" . PHP_EOL;
        }
    }

    /**
     * Returns informations about all Amazon Lightsail instances.
     * @return array $ret
     */
    public function getDataInstace()
    {
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
    public function getInstance()
    {
        $name = $this->getDataInstace()["name"];
        return $this->lightSailClient->getInstance(['instanceName' => $name]);
    }

    /**
     * Returns a name of instance
     */
    public function getInstanceName()
    {
        return $this->getDataInstace()["name"];
    }

    /**
     * Start a stopped Instance
     */
    public function startInstance()
    {
        try {
            $result = $this->lightSailClient->startInstance(['instanceName' => $this->getInstanceName()]);
        } catch (\Exception $e) {
            echo "Não foi possivel iniciar a instancia da Amazon Lightsail API." . PHP_EOL . "Messagem {$e->getMessage()}";
        }
    }

    /**
     * Stop a started Instance
     */
    public function stopInstance()
    {
        return $this->lightSailClient->stopInstance(['instanceName' => $this->getInstanceName()]);
    }

    /**
     * Restarts a specific instance. When your Amazon Lightsail instance is finished rebooting,
     * Lightsail assigns a new public IP address. To use the same IP address after restarting,
     * create a static IP address and attach it to the instance.
     *
     * @param $instance
     * @return \Aws\Result
     */
    public function rebootInstance($instance)
    {
        return $this->lightSailClient->rebootInstance(['instanceName' => $instance]);
    }

    public function deleteInstances() {
        try {
            $result = $this->lightSailClient->deleteInstance(['instanceName' => $this->getInstanceName()]);
        } catch (\Exception $e) {
            echo "Não foi possivel iniciar a instancia da Amazon Lightsail API." . PHP_EOL . "Messagem {$e->getMessage()}";
        }
    }

    /**
     * Attaches a static IP address to a specific Amazon Lightsail instance.
     * @param $params
     * @return \Aws\Result
     */
    public function attachStaticIp($params)
    {
        return $this->lightSailClient->attachStaticIp([
            'instanceName' => $params['instanceName'],
            'staticIpName' => $params['staticIpName']
        ]);
    }

    /**
     * Returns the data points for the specified Amazon Lightsail instance metric, given an instance name.
     * @param $params
     * @return \Aws\Result
     */
    public function getInstanceMetrics($params)
    {
        return $this->lightSailClient->getInstanceMetricData([
            'endTime' => $params['endTime'],//<integer || string || DateTime>, // REQUIRED
            'instanceName' => $params['instanceName'], // REQUIRED
            'metricName' => $params['metricName'],//'CPUUtilization|NetworkIn|NetworkOut|StatusCheckFailed|StatusCheckFailed_Instance|StatusCheckFailed_System', // REQUIRED
            'period' => $params['period'], // REQUIRED
            'startTime' => $params['startTime'],//<integer || string || DateTime>, // REQUIRED
            'statistics' => [$params['statistics']],//['<string>', ...], // REQUIRED
            'unit' => $params['unit']//'Seconds|Microseconds|Milliseconds|Bytes|Kilobytes|Megabytes|Gigabytes|Terabytes|Bits|Kilobits|Megabits|Gigabits|Terabits|Percent|Count|Bytes/Second|Kilobytes/Second|Megabytes/Second|Gigabytes/Second|Terabytes/Second|Bits/Second|Kilobits/Second|Megabits/Second|Gigabits/Second|Terabits/Second|Count/Second|None', // REQUIRED
        ]);
    }

    /**
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
            'customImageName' => $params['customImageName'],
            'instanceNames' => $params['instanceNames'],
            'keyPairName' => $params['keyPairName'],
            'userData' => $params['userData']
        ]);
    }

    /**
     * Deletes a specific Amazon Lightsail virtual private server, or instance.
     * @param $instance
     * @return \Aws\Result
     */
    public function deleteInstance($instance)
    {
        return  $this->lightSailClient->deleteInstance([
            'instanceName' => $instance
        ]);
    }

    public function openInstancePublicPorts($params)
    {
        return $this->lightSailClient->openInstancePublicPorts([
           'instanceName' => $params['instanceName'],
           'portInfo' => [
               'fromPort' => $params['fromPort'],
               'protocol' => $params['protocol'],
               'toPort' => $params['toPort']
           ]
        ]);
    }

    private function _getKey($config)
    {
        return $config['credentials']['access_key_ID'];
    }

    private function _getSecret($config)
    {
        return $config['credentials']['secret_access_key'];
    }
}
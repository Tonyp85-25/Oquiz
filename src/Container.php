<?php
namespace Oquiz;

use Closure;

class Container
{
    private $services;

    public function __construct()
    {
        $this->services=[];
    }

    /**
     * adds a new service to the container
     *
     * @param string $name
     * @param Closure $callback must be an anonymous function that returns a new instance of desired class
     * @return void
     */
    public function addService(string $name, Closure $callback)
    {
        if ($this->hasService($name)) {
            return;
        }
        $this->services[$name] = $callback;
    }

    /**
     * Undocumented function
     *
     * @param string $name
     * @return Closure
     */
    public function getService(string $name)
    {
        if ($this->hasService($name)) {
            return $this->services[$name];
        } else {
            throw new \Exception("Unknown Service", 1);
        }
    }

    public function hasService(string $name):bool
    {
        if (array_key_exists($name, $this->services)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * call the wanted services
     *
     * @param array string $serviceNames - the services' names we want to load
     * @return array  array of services instances
     */
    public function loadServices(array $serviceNames)
    {
        if (count($this->services) === 0 || count($serviceNames) === 0) {
            return;
        }

        $enabledServices =[];
        foreach ($serviceNames as $serviceName) {
            $service = $this->getService($serviceName);

            $enabledServices[] =$service();
        }

        return $enabledServices;
    }
}

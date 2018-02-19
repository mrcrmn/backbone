<?php

namespace Backbone\Foundation;

use Backbone\Services\Service;
use Psr\Container\ContainerInterface;
use Backbone\Foundation\Exceptions\ServiceNotFoundException;
use Backbone\Foundation\Exceptions\ServiceAlreadyRegisteredException;

/**
 * The application container which hosts all registered services.
 *
 * @package Backbone
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
class Application implements ContainerInterface
{
    /**
     * The array of services.
     *
     * @var array
     */
    public $services = [];

    public function __construct()
    {
        Service::setApplication($this);
    }

    /**
     * Registeres a service.
     *
     * @param  string $id The sevice name
     * @param  mixed $service The service instance
     * @return void
     */
    public function register($id, $service)
    {
        if (! $this->has($id)) {
            $this->services[$id] = $service;
        } else {
            throw new ServiceAlreadyRegisteredException("Service '{$id}' is already registered.");
        }
    }

    /**
     * Gets a service by key.
     *
     * @param  string $id The service name
     * @return mixed The service instance
     */
    public function get($id)
    {
        if ($this->has($id)) {
            return $this->services[$id];
        } else {
            throw new ServiceNotFoundException("The service '{$id}' has not been registered yet.");
        }
    }

    /**
     * Determines if the service does already exist.
     *
     * @param  string $id The service name
     * @return bool Whether or not the service already exists
     */
    public function has($id)
    {
        return array_key_exists($id, $this->services);
    }
}

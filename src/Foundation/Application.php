<?php

namespace Backbone\Foundation;

use Exception;
use Backbone\Facades\Facade;

/**
 * The application container which hosts all registered services.
 *
 * @package Backbone
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
class Application
{
    /**
     * The array of services.
     *
     * @var array
     */
    public $services = [];

    public function __construct()
    {
        Facade::setApplication($this);
    }

    /**
     * Registeres a service.
     *
     * @param  string $key The sevice name
     * @param  mixed $service The service instance
     * @return void
     */
    public function register($key, $service)
    {
        if (! $this->has($key)) {
            $this->services[$key] = $service;
        } else {
            throw new Exception("Service '{$key}' is already registered.");
        }
    }

    /**
     * Gets a service by key.
     *
     * @param  string $key The service name
     * @return mixed The service instance
     */
    public function get($key)
    {
        return $this->services[$key];
    }

    /**
     * Determines if the service does already exist.
     *
     * @param  string $key The service name
     * @return bool Whether or not the service already exists
     */
    public function has($key)
    {
        return array_key_exists($key, $this->services);
    }
}

<?php

namespace Backbone\Facades;

use Backbone\Foundation\Application;

/**
 * The Facade Base Class.
 *
 * @package Backbone
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
abstract class Facade
{
    /**
     * The application instance
     *
     * @var \Backbone\Foundation\Application
     */
    protected static $app;

    /**
     * The method needed to boot the Facade.
     *
     * @return void
     */
    abstract protected static function boot();

    /**
     * Sets the application instance from the bootstrapper.
     *
     * @param  \Backbone\Foundation\Application $app The application instance
     * @return void
     */
    public static function setApplication(Application $app)
    {
        static::$app = $app;
    }

    /**
     * Returns the service to the facade.
     *
     * @return $app
     */
    private static function getService()
    {
        return self::$app->get(static::SERVICE_NAME);
    }

    /**
     * The magic method which proxies the method call to the service.
     *
     * @param  mixed $method    the method to call
     * @param  mixed $arguments the arguments
     * @return mixed
     */
    public static function __callStatic($method, $arguments)
    {
        if (! static::$hasBeenBooted) {
            static::boot();
            static::$hasBeenBooted = true;
        }

        return self::getService()->$method(...$arguments);
    }

}

<?php

namespace Backbone\Facades;

/**
 * The Facade Base Class.
 *
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
abstract class Facade
{
    /**
     * The method needed to boot the Facade.
     *
     * @return void
     */
    abstract protected static function boot();

    /**
     * The function which returns the booted service.
     *
     * @var mixed
     */
    abstract protected static function getService();

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

        return static::getService()->$method(...$arguments);
    }
}

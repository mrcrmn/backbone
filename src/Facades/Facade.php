<?php

namespace Backbone\Facades;

abstract class Facade
{
    /**
     * Determine if the Facade has been booted.
     *
     * @var bool
     */
    protected static $hasBeenBooted = false;

    /**
     * The method needed to boot the Facade.
     *
     * @return void
     */
    protected abstract static function boot();

    /**
     * The function which returns the booted service.
     *
     * @var mixed
     */
    protected abstract static function getService();

    /**
     * The magic method which proxies the method call to the service.
     *
     * @param  mixed $method    the method to call
     * @param  mixed $arguments the arguments
     *
     * @return mixed
     */
    public static function __callStatic($method, $arguments)
    {
        // if the service has not been booted yet, we boot it duh.
        if (! static::$hasBeenBooted) {
            static::boot();
            static::$hasBeenBooted = true;
        }

        return static::getService()->$method(...$arguments);
    }
}

<?php

namespace Backbone\Facades;

use Backbone\Router\Router;
use Backbone\Facades\Facade;

class Route extends Facade
{
    /**
     * Determine if the Facade has been booted.
     *
     * @var bool
     */
    protected static $hasBeenBooted = false;

    /**
     * The Router instance.
     *
     * @var \Backbone\Router\Router
     */
    protected static $router;

    /**
     * Boots the Facade.
     *
     * @return void
     */
    protected static function boot()
    {
        self::$router = new Router;
    }

    /**
     * Returns the service to the facade.
     *
     * @return \Backbone\Router\Router
     */
    protected static function getService()
    {
        return self::$router;
    }
}

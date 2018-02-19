<?php

namespace Backbone\Facades;

use Backbone\Router\Router;
use Backbone\Facades\Facade;

/**
 * The Route Facade.
 *
 * @package Backbone
 * @author  Marco Reimann <marcoreimann@outlook.de>
 */
class Route extends Facade
{
    /**
     * The name of the service.
     *
     * @var string
     */
    protected const SERVICE_NAME = 'route';

    /**
     * Determine if the Facade has been booted.
     *
     * @var bool
     */
    protected static $hasBeenBooted = false;

    /**
     * Boots the Facade.
     *
     * @return void
     */
    protected static function boot()
    {
        static::$app->register(self::SERVICE_NAME, new Router());
    }
}

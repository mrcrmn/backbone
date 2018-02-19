<?php

namespace Backbone\Services;

use Backbone\Router\Router;
use Backbone\Services\Service;

/**
 * The Route Service.
 *
 * @package Backbone
 * @author  Marco Reimann <marcoreimann@outlook.de>
 */
class Route extends Service
{
    /**
     * The name of the service.
     *
     * @var string
     */
    protected const SERVICE_NAME = 'route';

    /**
     * Determine if the Service has been booted.
     *
     * @var bool
     */
    protected static $hasBeenBooted = false;

    /**
     * Boots the Service.
     *
     * @return void
     */
    protected static function boot()
    {
        static::$app->register(self::SERVICE_NAME, new Router());
    }
}

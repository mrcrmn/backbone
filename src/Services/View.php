<?php

namespace Backbone\Services;

use Backbone\Services\Service;
use duncan3dc\Laravel\BladeInstance;

/**
 * The Service for the blade template engine.
 *
 * @package Backbone
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
class View extends Service
{
    /**
     * The name of the service.
     *
     * @var string
     */
    protected const SERVICE_NAME = 'view';

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
        $paths = getConfig('view');
        static::$app->register(self::SERVICE_NAME, new BladeInstance($paths['templates'], $paths['cache']));
    }
}

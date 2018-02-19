<?php

namespace Backbone\Facades;

use Backbone\Facades\Facade;
use duncan3dc\Laravel\BladeInstance;

/**
 * The facade for the blade template engine.
 *
 * @package Backbone
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
class View extends Facade
{
    /**
     * The name of the service.
     *
     * @var string
     */
    protected const SERVICE_NAME = 'view';

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
        $paths = getConfig('view');
        static::$app->register(self::SERVICE_NAME, new BladeInstance($paths['templates'], $paths['cache']));
    }
}

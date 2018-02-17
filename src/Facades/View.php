<?php

namespace Backbone\Facades;

use Backbone\Facades\Facade;
use duncan3dc\Laravel\BladeInstance;

class View extends Facade
{
    /**
     * Determine if the Facade has been booted.
     *
     * @var bool
     */
    protected static $hasBeenBooted = false;

    /**
     * The Blade instance.
     *
     * @var \duncan3dc\Laravel\BladeInstance
     */
    protected static $blade;

    /**
     * Boots the Facade.
     *
     * @return void
     */
    protected static function boot()
    {
        $paths = getConfig('view');
        self::$blade = new BladeInstance($paths['templates'], $paths['cache']);
    }

    /**
     * Returns the service to the facade.
     *
     * @return \duncan3dc\Laravel\BladeInstance the Blade instance
     */
    protected static function getService()
    {
        return self::$blade;
    }
}

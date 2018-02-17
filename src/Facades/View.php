<?php

namespace Backbone\Facades;

use Backbone\Facades\Facade;
use duncan3dc\Laravel\BladeInstance;

class View extends Facade
{
    /**
     * The Blade instance.
     *
     * @var \duncan3dc\Laravel\BladeInstance
     */
    protected static $blade;

    /**
     * Boots the Facade.
     * @method boot
     *
     * @return void
     */
    protected static function boot()
    {
        self::$blade = new BladeInstance(base_path('resources/views'), base_path('storage/cache/views'));
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

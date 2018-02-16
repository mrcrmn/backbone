<?php

namespace Backbone\Facades;

use Backbone\Facades\Facade;
use duncan3dc\Laravel\BladeInstance;

class View extends Facade
{
    /**
     * The Blade instance.
     * @var \duncan3dc\Laravel\BladeInstance
     */
    protected static $blade;

    /**
     * Boots the Facade.
     * @method boot
     * @return void
     */
    protected static function boot()
    {
        self::$blade = new BladeInstance(base_path('resources/views'), base_path('storage/cache/views'));
    }

    /**
     * Renders a View.
     * @method render
     * @param  string $template the path to the template
     * @param  array $data     the data which is needed to render the view
     * @return string           the rendered template
     */
    public static function render($template, $data)
    {
        if (! self::$hasBeenBooted) {
            self::boot();
        }

        return self::$blade->render($template, $data);
    }
}

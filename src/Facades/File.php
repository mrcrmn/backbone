<?php

namespace Backbone\Facades;

use Backbone\Facades\Facade;
use Symfony\Component\Filesystem\Filesystem;

class File extends Facade
{
    /**
     * The Blade instance.
     *
     * @var \Symfony\Component\Filesystem\Filesystem
     */
    protected static $filesystem;

    /**
     * Boots the Facade.
     *
     * @return void
     */
    protected static function boot()
    {
        self::$filesystem = new Filesystem();
    }

    /**
     * Returns the service to the facade.
     *
     * @return \Symfony\Component\Filesystem\Filesystem
     */
    protected static function getService()
    {
        return self::$filesystem;
    }
}

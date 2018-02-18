<?php

namespace Backbone\Facades;

use Backbone\Facades\Facade;
use Symfony\Component\Filesystem\Filesystem;

/**
 * The facade for the symfony file system.
 *
 * @package Backbone
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
class File extends Facade
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

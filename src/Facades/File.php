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
     * The name of the service.
     *
     * @var string
     */
    protected const SERVICE_NAME = 'file';

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
        static::$app->register(self::SERVICE_NAME, new Filesystem());
    }

}

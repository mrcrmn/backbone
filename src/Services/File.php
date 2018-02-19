<?php

namespace Backbone\Services;

use Backbone\Services\Service;
use Symfony\Component\Filesystem\Filesystem;

/**
 * The Service for the symfony file system.
 *
 * @package Backbone
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
class File extends Service
{
    /**
     * The name of the service.
     *
     * @var string
     */
    protected const SERVICE_NAME = 'file';

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
        static::$app->register(self::SERVICE_NAME, new Filesystem());
    }
}

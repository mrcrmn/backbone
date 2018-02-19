<?php

namespace Backbone\Facades;

use Monolog\Logger;
use Backbone\Facades\Facade;
use Monolog\Handler\StreamHandler;

/**
 * The facade for the logger.
 *
 * @package Backbone
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
class Log extends Facade
{
    /**
     * Determine if the Facade has been booted.
     *
     * @var bool
     */
    protected static $hasBeenBooted = false;

    /**
     * The Log instance.
     *
     * @var \Monolog\Logger
     */
    protected static $logger;

    /**
     * Boots the Facade.
     *
     * @return void
     */
    protected static function boot()
    {
        self::$logger = new Logger('logger');
        self::$logger->pushHandler(new StreamHandler(base_path('storage/logs/log.txt')));
    }

    /**
     * Returns the service to the facade.
     *
     * @return \Monolog\Logger
     */
    protected static function getService()
    {
        return self::$logger;
    }
}

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
     * The name of the service.
     *
     * @var string
     */
    protected const SERVICE_NAME = 'log';

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
        $logger = new Logger('logger');
        $logger->pushHandler(new StreamHandler(base_path('storage/logs/log.txt')));

        static::$app->register(self::SERVICE_NAME, $logger);
    }
}

<?php

namespace Backbone\Services;

use Monolog\Logger;
use Backbone\Services\Service;
use Monolog\Handler\StreamHandler;

/**
 * The Service for the logger.
 *
 * @package Backbone
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
class Log extends Service
{
    /**
     * The name of the service.
     *
     * @var string
     */
    protected const SERVICE_NAME = 'log';

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
        $logger = new Logger('logger');
        $logger->pushHandler(new StreamHandler(base_path('storage/logs/log.txt')));

        static::$app->register(self::SERVICE_NAME, $logger);
    }
}

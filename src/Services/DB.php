<?php

namespace Backbone\Services;

use Backbone\Services\Service;
use Backbone\Database\Database;

/**
 * The database Service.
 *
 * @package Backbone
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
class DB extends Service
{
    /**
     * The name of the service.
     *
     * @var string
     */
    protected const SERVICE_NAME = 'DB';

    /**
     * Determine if the Service has been booted.
     *
     * @var bool
     */
    public static $hasBeenBooted = false;

    /**
     * Boots the Service.
     *
     * @return void
     */
    protected static function boot()
    {
        $db = new Database();
        $db->connect(
            env('MYSQL_HOST', '127.0.0.1'),
            env('MYSQL_USER', 'root'),
            env('MYSQL_PASSWORD', ''),
            env('MYSQL_PORT', '3306'),
            env('MYSQL_DATABASE', 'database')
        );

        static::$app->register(self::SERVICE_NAME, $db);
    }
}

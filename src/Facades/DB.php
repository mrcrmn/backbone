<?php

namespace Backbone\Facades;

use Backbone\Facades\Facade;
use Backbone\Database\Database;

/**
 * The database facade.
 *
 * @package Backbone
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
class DB extends Facade
{
    /**
     * The name of the service.
     *
     * @var string
     */
    protected const SERVICE_NAME = 'DB';

    /**
     * Determine if the Facade has been booted.
     *
     * @var bool
     */
    public static $hasBeenBooted = false;

    /**
     * Boots the Facade.
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

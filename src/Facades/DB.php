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
     * Determine if the Facade has been booted.
     *
     * @var bool
     */
    protected static $hasBeenBooted = false;

    /**
     * The Database instance.
     *
     * @var \Backbone\Database\Database
     */
    protected static $db;

    /**
     * Boots the Facade.
     *
     * @return void
     */
    protected static function boot()
    {
        self::$db = new Database();
        self::$db->connect(
            env('MYSQL_HOST', '127.0.0.1'),
            env('MYSQL_USER', 'root'),
            env('MYSQL_PASSWORD', ''),
            env('MYSQL_PORT', '3306'),
            env('MYSQL_DATABASE', 'database')
        );
    }

    /**
     * Returns the service to the facade.
     *
     * @return \Backbone\Database\Database
     */
    protected static function getService()
    {
        return self::$db;
    }
}

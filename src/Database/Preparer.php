<?php

namespace Backbone\Database;

use Backbone\Database\Connectors\DatabaseConnection;

/**
 * Class which proxies the DatabaseConnection class.
 *
 * @package Backbone
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
class Preparer
{
    /**
     * The PDO Database Connection.
     *
     * @var \Backbone\Database\Connectors\DatabaseConnection
     */
    public $connection;

    /**
     * Connects to the Database.
     *
     * @param  string  $host
     * @param  string  $username
     * @param  string  $password
     * @param  int $port
     * @param  string  $database
     *
     * @return bool
     */
    public function __construct($host = "127.0.0.1", $username = "root", $password = "", $port = 3306, $database = "")
    {
        $this->connection = new DatabaseConnection($host, $username, $password, $port, $database);
    }

    /**
     * Disconnects the database connection.
     *
     * @return $this
     */
    public function disconnect()
    {
        $this->connection = null;

        return $this;
    }

    /**
     * Proxy for the Pdo.
     *
     * @param  string $method
     * @param  mixed $args
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        return $this->connection->$method(...$args);
    }

}

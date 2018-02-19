<?php

/**
 * This file is part of ezpdo.
 *
 * @author Marco Reimann <marcoreimann@outlook.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Backbone\Database\Connectors;

/**
* The Mysql Database Conncetor.
*/
class DatabaseConnection extends \PDO
{
    protected $driver = "mysql";

    protected $dns;

    protected $username;

    protected $password;

    protected $database;
    
    public function __construct(string $host, string $username, string $password, int $port, string $database)
    {
        $this->dns = $this->resolveDns($host, $port, $database);

        parent::__construct($this->dns, $username, $password);
    }

    protected function resolveDns($host, $port, $database)
    {
        return sprintf("%s:dbname=%s;host=%s;port=%d", $this->driver, $database, $host, $port);
    }
}

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
    /**
     * The database driver.
     *
     * @var string
     */
    protected $driver = "mysql";

    /**
     * The resolved DNS.
     *
     * @var string
     */
    protected $dns;

    /**
     * The username.
     *
     * @var string
     */
    protected $username;

    /**
     * The password.
     *
     * @var string
     */
    protected $password;

    /**
     * The database name
     *
     * @var string
     */
    protected $database;

    /**
     * Creates a new PDO Instance.
     *
     * @param string $host     The hostname.
     * @param string $username The Username.
     * @param string $password The Password.
     * @param int    $port     The Port.
     * @param string $database The Database name.
     */
    public function __construct($host, $username, $password, $port, $database)
    {
        $this->dns = $this->resolveDns($host, $port, $database);

        parent::__construct($this->dns, $username, $password);
    }

    /**
     * Resolves the DNS part for the PDO connection.
     *
     * @param  string $host     The hostname.
     * @param  int $port     The port.
     * @param  string $database The database name.
     *
     * @return string
     */
    protected function resolveDns($host, $port, $database)
    {
        return sprintf("%s:dbname=%s;host=%s;port=%d", $this->driver, $database, $host, $port);
    }
}

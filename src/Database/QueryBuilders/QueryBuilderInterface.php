<?php

namespace Backbone\Database\QueryBuilders;

use Backbone\Database\Database;

/**
 * The query builder contract.
 *
 * @package Backbone
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
interface QueryBuilderInterface
{
    public function __construct(Database $db);

    public function build();
}

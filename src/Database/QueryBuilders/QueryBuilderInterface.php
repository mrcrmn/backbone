<?php

/**
 * This file is part of ezpdo.
 * 
 * @author Marco Reimann <marcoreimann@outlook.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Backbone\Database\QueryBuilders;

use Backbone\Database\Database;

interface QueryBuilderInterface
{

	public function __construct(Database $db);

	public function build();
}
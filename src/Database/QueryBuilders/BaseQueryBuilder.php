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

/**
* This Class has methods which are needed to turn the Data from the collector into subqueries.
*/
class BaseQueryBuilder
{
    
    public function addDistinct()
    {
        if ($this->db->isDistinct) {
            return " DISTINCT";
        }
    }

    public function addWheres()
    {
        if (! empty($this->db->wheres)) {
            return " " . implode(" ", $this->db->wheres);
        }
    }

    public function addGroupBys()
    {
        if (! empty($this->db->groupyBys)) {
            return " " . implode(" ", $this->db->groupyBys);
        }
    }

    public function addOrderBys()
    {
        if (! empty($this->db->orderBys)) {
            return " ORDER BY " . implode(", ", $this->db->orderBys);
        }
    }

    public function addJoins()
    {
        $joins = $this->db->joins;

        if (! empty($joins)) {
            return " " . implode(" ", $joins);
        }
    }

    public function addLimit()
    {
        if (isset($this->db->limit)) {
            return " LIMIT " . $this->db->limit;
        }
    }

    public function addOffset()
    {
        if (isset($this->db->offset)) {
            return " OFFSET " . $this->db->offset;
        }
    }
}
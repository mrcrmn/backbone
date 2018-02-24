<?php

namespace Backbone\Database\QueryBuilders;

/**
* This Class has methods which are needed to turn the Data from the collector into subqueries.
*
* @package Backbone
* @author Marco Reimann <marcoreimann@outlook.de>
*/
class BaseQueryBuilder
{
    /**
     * Returns the full insert query.
     *
     * @return string
     */
    public function addInsert()
    {
        return sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",

            $this->collector->table,
            $this->collector->inserts['columns'],
            $this->collector->inserts['values']
        );
    }

    /**
     * Returns the full insert query.
     *
     * @return string
     */
    public function addUpdate()
    {
        return sprintf("UPDATE %s SET %s", $this->collector->table, implode(', ', $this->collector->updates));
    }

    /**
     * Adds the delete base query.
     *
     * @return string
     */
    public function addDelete()
    {
        return sprintf("DELETE FROM %s", $this->collector->table);
    }

    /**
     * Adds a select distinct subquery.
     */
    public function addDistinct()
    {
        if ($this->collector->isDistinct) {
            return " DISTINCT";
        }
    }

    /**
     * Returns all where subqueries.
     *
     * @return string
     */
    public function addWheres()
    {
        if (! empty($this->collector->wheres)) {
            return " " . implode(" ", $this->collector->wheres);
        }
    }

    /**
     * Returns all group by subqueries.
     *
     * @return string
     */
    public function addGroupBys()
    {
        if (! empty($this->collector->groupyBys)) {
            return " " . implode(" ", $this->collector->groupyBys);
        }
    }

    /**
     * Returns all order by subqueries.
     *
     * @return string
     */
    public function addOrderBys()
    {
        if (! empty($this->collector->orderBys)) {
            return " ORDER BY " . implode(", ", $this->collector->orderBys);
        }
    }

    /**
     * Adds all jouns to the query.
     *
     * @return string
     */
    public function addJoins()
    {
        $joins = $this->collector->joins;

        if (! empty($joins)) {
            return " " . implode(" ", $joins);
        }
    }

    /**
     * Adds the limit to the query.
     *
     * @return string
     */
    public function addLimit()
    {
        if (isset($this->collector->limit)) {
            return " LIMIT " . $this->collector->limit;
        }
    }

    /**
     * Adds the offset to the query.
     *
     * @return string
     */
    public function addOffset()
    {
        if (isset($this->collector->offset)) {
            return " OFFSET " . $this->collector->offset;
        }
    }
}

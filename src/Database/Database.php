<?php

/**
 * This file is part of ezpdo.
 * 
 * @author Marco Reimann <marcoreimann@outlook.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Backbone\Database;

use Backbone\Database\Collector;

/**
* The main class which hosts the public API.
*/
class Database extends Collector
{

    /**
     * INSERT|SELECT|UPDATE|DELETE
     * 
     * @var string
     */
    public $action;

    /**
     * List of all available actions.
     * 
     * @var array
     */
    public $actions = ['INSERT', 'SELECT', 'UPDATE', 'DELETE'];

    /**
     * Builds the insert statement. Accepts an assoc array [$key => $value].
     * 
     * @param  array $values
     * 
     * @return $this
     */
    public function insert($values)
    {
        $this->action = 'INSERT';

        $this->builder = new InsertQueryBuilder($table, $values);
        $this->preparer = new Preparer($this->connection, $this->builder);

        $this->prepared = $this->preparer->getPrepared();

        return $this;
    }

    /**
     * The start of the select statement.
     * 
     * @param  array|string $columns
     * 
     * @return $this
     */
    public function select($columns = ['*'])
    {
        $this->action = 'SELECT';

        $columns = is_array($columns) ? $columns : func_get_args();
        $this->makeColumns($columns);
        
        return $this;
    }

    /**
     * The beginning of the update statement.
     * 
     * @return $this
     */
    public function update()
    {
        $this->action = 'UPDATE';

        return $this;
    } 

    /**
     * The beginning of the update statement.
     * 
     * @return $this
     */
    public function delete()
    {
        $this->action = 'DELETE';

        return $this;
    }

    /**
     * Setter for the table.
     * @param  string $table
     * @return $this
     */
    public function into($table)
    {
        $this->setTable($table);

        return $this;
    }

    /**
     * Setter for the table.
     * @param  string $table
     * @return $this
     */
    public function from($table)
    {
        $this->setTable($table);

        return $this;
    }

    /**
     * Sets the distinct value to true.
     * 
     * @return $this
     */
    public function distinct()
    {
        $this->isDistinct = true;

        return $this;
    }

    /**
     * Adds a where clause.
     * 
     * @param  string       $column
     * @param  string       $operator
     * @param  string|int   $value
     * @param  string       $boolean
     * 
     * @return $this
     */
    public function where($column, $operator, $value = NULL, $boolean = 'AND')
    {
        $this->addWhere($column, $operator, $value, $boolean);

        return $this;
    }

    /**
     * Adds a or where clause.
     * 
     * @param  string       $column
     * @param  string       $operator
     * @param  string|int   $value
     * @param  string       $boolean
     * 
     * @return $this
     */
    public function orWhere($column, $operator, $value = NULL)
    {
        return $this->where($column, $operator, $value, 'OR');
    }

    /**
     * TODO
     * 
     * @return $this
     */
    public function whereIn($column, $array, $boolean = 'AND')
    {
        $this->addWhereIn($column, $array, $boolean);

        return $this;
    }

    /**
     * TODO
     * 
     * @return $this
     */
    public function orWhereIn($column, $array)
    {
        return $this->whereIn($column, $array, 'OR');
    }

    /**
     * Adds a order by subquery.
     * 
     * @param  string $column
     * @param  string $direction
     * 
     * @return $this
     */
    public function orderBy($column, $direction = 'ASC')
    {
        $this->addOrderBy($column, $direction);

        return $this;
    }

    /**
     * Adds a order by subquery.
     * 
     * @param  string $column
     * 
     * @return $this
     */
    public function groupBy($column)
    {
        $this->addGroupBy($column);

        return $this;
    }

    /**
     * Adds a basic inner join to the query.
     * 
     * @param  string $onTable     
     * @param  string $firstColumn 
     * @param  string $secondColumn
     * @param  string $type        
     * 
     * @return $this
     */
    public function join($onTable, $secondColumn = NULL, $firstColumn = 'id', $type = 'INNER')
    {
        $this->addJoin($onTable, $secondColumn, $firstColumn = 'id', $type);

        return $this;
    }

    /**
     * Adds a left join to the query.
     * 
     * @param  string $onTable     
     * @param  string $firstColumn 
     * @param  string $secondColumn
     * 
     * @return $this
     */
    public function leftJoin($onTable, $secondColumn = NULL, $firstColumn = 'id')
    {
        return $this->join($onTable, $secondColumn, $firstColumn = 'id', 'LEFT OUTER');
    }

    /**
     * Adds a right join to the query.
     * 
     * @param  string $onTable     
     * @param  string $firstColumn 
     * @param  string $secondColumn
     * 
     * @return $this
     */
    public function rightJoin($onTable, $firstColumn = NULL, $secondColumn)
    {
        return $this->join($onTable, $firstColumn, $secondColumn, 'RIGHT OUTER');
    }

    /**
     * Adds a limit to the query.
     * 
     * @param  integer $limit
     * 
     * @return $this
     */
    public function limit($limit)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * Adds a offset to the query.
     * 
     * @param  integer $offset
     * 
     * @return $this
     */
    public function offset($offset)
    {
        $this->offset = $offset;

        return $this;
    }

    public function getQuery()
    {
        return $this->buildQuery();
    }

    /**
     * Gets an array after the select statement is executed.
     * 
     * @return array
     */
    public function get()
    {
        if (empty($this->connection)) {
            return $this->getQuery();
        }

        $this->prepare();
        $this->run();

        return $this->prepared->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Sets the limit to 1, executes the query and returns the first result.
     * 
     * @return array
     */
    public function first()
    {
        $this->limit = 1;

        return $this->get();
    }

    /**
     * Gets the count of the selected rows.
     * 
     * @return integer
     */
    public function count()
    {
        $this->prepare();
        $this->run();

        return intval($this->prepared->rowCount());
    }

    /**
     * Executes the prepared statement.
     * 
     * @return bool
     */
    public function run()
    {   
        return $this->execPreparedStatement();
    }
}
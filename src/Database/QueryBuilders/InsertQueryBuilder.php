<?php

namespace Backbone\Database\QueryBuilders;

use Backbone\Database\QueryBuilders\BaseQueryBuilder;

/**
 * Constructs an insert query.
 *
 * @package Backbone
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
class InsertQueryBuilder extends BaseQueryBuilder
{

    /**
     * The table where the data should be inserted.
     * @var string
     */
    protected $table;

    protected $array;

    protected $keys;

    public $values;

    public $statement;

    protected $columnString;

    protected $paramString;

    public $unboundParameters;

    public function __construct(string $table, array $array)
    {
        $this->table = $table;
        $this->array = $array;
        $this->keys = array_keys($array);
        $this->values = array_values($array);

        $this->statement = "INSERT INTO %s (%s) VALUES (%s)";

        $this->columnString = $this->stringifyArray($this->keys);
        $this->paramString = $this->stringifyArray($this->keys, ':');

        $this->unboundParameters = $this->parameterizeKeys($this->keys);

        $this->statement = sprintf($this->statement, $this->table, $this->columnString, $this->paramString);
    }
}

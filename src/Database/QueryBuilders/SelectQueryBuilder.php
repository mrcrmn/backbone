<?php

namespace Backbone\Database\QueryBuilders;

use Exception;
use Backbone\Database\Collector;
use Backbone\Database\QueryBuilders\BaseQueryBuilder;
use Backbone\Database\QueryBuilders\QueryBuilderInterface;
/**
 * Constructs a select query.
 *
 * @package Backbone
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
class SelectQueryBuilder extends BaseQueryBuilder implements QueryBuilderInterface
{

    /**
     * The connection instance.
     *
     * @var \Backbone\Database\Collector
     */
    protected $collector;

    /**
     * The query.
     *
     * @var string
     */
    public $query;

    /**
     * The constructor needs all parameters which have been collected by the public API.
     *
     * @param Collector $collector
     */
    public function __construct(Collector $collector)
    {
        $this->collector = $collector;
    }

    /**
     * Adds the basic SELCET ... FROM ... to the query.
     *
     * @return  string
     */
    public function addBaseSelect()
    {
        if (empty($this->collector->selectColumns)) {
            throw new Exception('Nothing to Select.');
        }

        if (empty($this->collector->table)) {
            throw new Exception('No table selected.');
        }

        // 1. %s-> DISTINCT; 2. %s->column_1, column_2; 3. %s-> table_name
        return sprintf("SELECT%s %s FROM %s", $this->addDistinct(), $this->collector->selectColumns, $this->collector->table);
    }

    /**
     * When this function is called, the full query is being compiled and returned.
     *
     * @return string
     */
    public function build()
    {
        $this->query = $this->addBaseSelect();
        $this->query .= $this->addJoins();
        $this->query .= $this->addWheres();
        $this->query .= $this->addGroupBys();
        $this->query .= $this->addOrderBys();
        $this->query .= $this->addLimit();
        $this->query .= $this->addOffset();

        return $this->query;
    }
}

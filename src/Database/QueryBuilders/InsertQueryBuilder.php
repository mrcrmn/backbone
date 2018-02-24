<?php

namespace Backbone\Database\QueryBuilders;

use Backbone\Database\Collector;
use Backbone\Database\QueryBuilders\BaseQueryBuilder;
use Backbone\Database\QueryBuilders\QueryBuilderInterface;

/**
 * Constructs an insert query.
 *
 * @package Backbone
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
class InsertQueryBuilder extends BaseQueryBuilder implements QueryBuilderInterface
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

    public function build()
    {
        $this->query = $this->addInsert();

        return $this->query;
    }
}

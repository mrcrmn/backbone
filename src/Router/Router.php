<?php

namespace mrcrmn\Backbone\Router;

use FastRoute\RouteCollector;
use FastRoute\RouteParser\Std as RouteParser;
use FastRoute\Dispatcher\GroupCountBased as Dispatcher;
use FastRoute\DataGenerator\GroupCountBased as Generator;

class Router extends RouteCollector
{

    public function __construct() {
        parent::__construct(new RouteParser, new Generator);
    }
    
    public function dispatch($method, $uri)
    {
        $dispatcher = new Dispatcher($this->getData());
        return $dispatcher->dispatch($method, $uri);
    }
}

<?php

namespace Backbone\Router;

use Backbone\Services\View;
use FastRoute\RouteCollector;
use FastRoute\RouteParser\Std as RouteParser;
use FastRoute\Dispatcher\GroupCountBased as Dispatcher;
use FastRoute\DataGenerator\GroupCountBased as Generator;

/**
 * The FastRoute Wrapper.
 *
 * @package Backbone
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
class Router extends RouteCollector
{
    /**
     * Constructs a new FastRoute Instance.
     *
     * @return $this
     */
    public function __construct()
    {
        parent::__construct(new RouteParser, new Generator);

        return $this;
    }

    /**
     * A special method, which allows the route to directly render a view.
     *
     * @param  string $route The route.
     * @param  string $view The view which should be rendered.
     *
     * @param  array $data An array of data which should be passed to the route.
     *
     * @return string The Response content.
     */
    public function view($route, $view, $data = [])
    {
        $this->addRoute('GET', $route, function () use ($view, $data) {
            return View::render($view, $data);
        });
    }

    /**
     * Dispatches the router and returns the matched info and dynamic attributes.
     *
     * @param  string $method The HTTP method.
     * @param  string $uri The request uri.
     *
     * @return array The route info.
     */
    public function dispatch($method, $uri)
    {
        $dispatcher = new Dispatcher($this->getData());
        return $dispatcher->dispatch($method, $uri);
    }
}

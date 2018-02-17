<?php

namespace Backbone\Http;

use FastRoute\Dispatcher;
use Backbone\Facades\Route;
use Symfony\Component\HttpFoundation\Request;
use Backbone\Http\Exceptions\RouteNotFoundException;
use Backbone\Http\Exceptions\MethodNotAllowedException;

/**
 * Resolves the Route and returns the info for the controller.
 *
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
class RouteResolver
{
    /**
     * Gets the route info from the passed request.
     *
     * @param  Request $request the request object
     * @return array the route info [0 => STATUS_CODE, 1 => CONTROLLER::METHOD, 2 => ARGUMENTS]
     */
    public static function resolve(Request $request)
    {
        foreach (getConfig('route') as $routePath) {
            require_once $routePath;
        }

        $routeInfo = Route::dispatch(self::getHttpMethod($request), $request->getRequestUri());

        self::resolveStatusCode($routeInfo[0]);

        return $routeInfo;
    }

    /**
     * Gets the HTTP Request method from the Request Object.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request the request which contains info about the method
     * @return string The Http Method
     */
    protected static function getHttpMethod($request)
    {
        return $request->server->get('REQUEST_METHOD');
    }

    /**
     * resolves the status code and throws exceptions.
     *
     * @param  int $status The status code
     *
     * @throws \Backbone\Http\Exceptions\RouteNotFoundException Thrown when the route is not found
     * @throws \Backbone\Http\Exceptions\MethodNotAllowedException Thrown when method is not allowed
     * @return void
     */
    protected static function resolveStatusCode($status)
    {
        if ($status === Dispatcher::NOT_FOUND) {
            throw new RouteNotFoundException("Route not found");
        }

        if ($status === Dispatcher::METHOD_NOT_ALLOWED) {
            throw new MethodNotAllowedException("Method not allowed");
        }
    }
}

<?php

namespace Backbone\Http;

use FastRoute\Dispatcher;
use Backbone\Http\Request;
use Backbone\Services\Route;
use Backbone\Http\Exceptions\RouteNotFoundException;
use Backbone\Http\Exceptions\MethodNotAllowedException;

/**
 * Resolves the Route and returns the info for the controller.
 *
 * @package Backbone
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
class RouteResolver
{
    /**
     * Gets the route info from the passed request.
     *
     * @param  \Backbone\Http\Request $request The request object.
     *
     * @return array The route info [0 => STATUS_CODE, 1 => CONTROLLER::METHOD, 2 => ARGUMENTS]
     */
    public static function resolve(Request $request)
    {
        // Get all route files.
        foreach (getConfig('route') as $routePath) {
            require_once $routePath;
        }

        // Dispatch the route and get info.
        $routeInfo = Route::dispatch(self::getHttpMethod($request), $request->getRequestUri());
        self::resolveStatusCode($routeInfo[0]);

        // If the routes contains attributes, add them to the attributes request parameter bag.
        if (isset($routeInfo[2])) {
            $request->setAttributes($routeInfo[2]);
        }

        return $routeInfo;
    }

    /**
     * Gets the HTTP Request method from the Request Object.
     *
     * @param  \Backbone\Http\Request $request The request which contains info about the method.
     *
     * @return string The Http Method.
     */
    protected static function getHttpMethod($request)
    {
        return $request->server->get('REQUEST_METHOD');
    }

    /**
     * Resolves the status code and throws exceptions.
     *
     * @param  int $status The status code.
     *
     * @return void
     *
     * @throws RouteNotFoundException Thrown when the route is not found.
     * @throws MethodNotAllowedException Thrown when method is not allowed.
     */
    protected static function resolveStatusCode($status)
    {
        if ($status === Dispatcher::NOT_FOUND) {
            throw new RouteNotFoundException("Route not found :(");
        }

        if ($status === Dispatcher::METHOD_NOT_ALLOWED) {
            throw new MethodNotAllowedException("Method not allowed");
        }
    }
}

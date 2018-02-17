<?php

namespace Backbone\Http;

use Symfony\Component\HttpFoundation\Request;

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
     *
     * @return array the route info [0 => STATUS_CODE, 1 => CONTROLLER::METHOD, 2 => ARGUMENTS]
     */
    public static function resolve(Request $request)
    {
        $router = require_once base_path('routes/web.php');

        return $router->dispatch(self::getHttpMethod($request), $request->getRequestUri());
    }

    /**
     * Gets the HTTP Request method from the Request Object.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request the request which contains info about the method
     *
     * @return string The Http Method
     */
    protected static function getHttpMethod($request)
    {
        return $request->server->get('REQUEST_METHOD');
    }
}

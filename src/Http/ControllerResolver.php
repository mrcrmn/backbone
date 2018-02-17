<?php

namespace Backbone\Http;

use Symfony\Component\HttpFoundation\Request;

/**
 * Static class which resolves a controller and calls it.
 *
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
class ControllerResolver
{
    /**
     * The Controller Namespace.
     *
     * @var string
     */
    protected const NAMESPACE = "\\App\\Http\\";

    /**
     * Resolves the Controller and calls it.
     *
     * @param  array $routeInfo the route info
     * @param  Request $request the Request
     *
     * @return string the response content
     */
    public static function resolve($routeInfo, Request $request)
    {
        $controllerInfoArray = self::getControllerInfoArray($routeInfo[1]);

        $controller = self::getControllerInstanceFromInfo($controllerInfoArray);
        $method = self::getMethodFromInfo($controllerInfoArray);

        return call_user_func_array([$controller, $method], [$request]);
    }

    /**
     * Explodes the controller string into the controller and the method.
     *
     * @param  string $info the route info
     *
     * @return array [string CONTROLLER, string METHOD]
     */
    protected static function getControllerInfoArray($info)
    {
        return explode('::', $info);
    }

    /**
     * Gets a new controller instance.
     *
     * @param  array $array the controller array which contains the controller name and method name.
     *
     * @return \App\Http\Controller the controller instance
     */
    protected static function getControllerInstanceFromInfo($array)
    {
        $controller = self::NAMESPACE . $array[0];
        return new $controller();
    }

    /**
     * Gets the method name to call.
     *
     * @param  array $array the controller array which contains the controller name and method name.
     *
     * @return string the method name
     */
    protected static function getMethodFromInfo($array) {
        return $array[1];
    }
}

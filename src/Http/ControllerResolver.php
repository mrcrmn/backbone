<?php

namespace Backbone\Http;

use Closure;
use Symfony\Component\HttpFoundation\Request;

/**
 * Static class which resolves a controller and calls it.
 *
 * @package Backbone
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
     * @param  \Closure|string $callback The controller string.
     * @param  \Symfony\Component\HttpFoundation\Request $request The Request object.
     *
     * @return string The response content
     */
    public static function resolve($callback, Request $request)
    {
        // If the callback is a closure just call it.
        if ($callback instanceof Closure) {
            return $callback($request);
        }

        $controllerInfoArray = self::getControllerInfoArray($callback);

        $controller = self::getControllerInstanceFromInfo($controllerInfoArray);
        $method = self::getMethodFromInfo($controllerInfoArray);

        // Calls the controller and its method.
        return call_user_func_array([$controller, $method], [$request]);
    }

    /**
     * Explodes the controller string into the controller and the method.
     *
     * @param  string $info The controller name.
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
     * @param  array $array The controller array which contains the controller name and method name.
     *
     * @return \App\Http\Controller The controller instance
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
     * @return string The method name
     */
    protected static function getMethodFromInfo($array)
    {
        return $array[1];
    }
}

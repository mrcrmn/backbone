<?php

use Backbone\Facades\View;

if (! function_exists('dd')) {
    function dd($var)
    {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
        die();
    }
}

if (! function_exists('env')) {
    function env($key, $default = null)
    {
        return getenv($key) ?: $default;
    }
}

if (! function_exists('getConfig')) {
    /**
     * Returns the config array.
     *
     * @param  string $key The config key eg. route, view, commands
     *
     * @return array The configuration
     */
    function getConfig($key)
    {
        return require_once base_path('config/' . $key . '.php');
    }
}

if (! function_exists('view')) {
    function view($view, $data)
    {
        return View::render($view, $data);
    }
}

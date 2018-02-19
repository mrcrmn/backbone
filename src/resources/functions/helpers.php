<?php
/**
 * Helper functions for the Backbone Framework
 *
 * @package Backbone
 * @author Marco Reimann <marcoreimann@outlook.de>
 */

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

if (! function_exists('asset')) {
    function asset($file)
    {
        $file = ltrim($file, '/');
        $realpath = base_path('public/' . $file);

        if (! file_exists($realpath)) {
            throw new Exception("File '{$file}' doesn't exist.");
        }

        $version = '?v=' . hash('adler32', filemtime($realpath));

        return env('APP_URL', '') . '/' . $file . $version;
    }
}

if (! function_exists('getConfig')) {
    /**
     * Returns the config array.
     *
     * @param  string $key The config key eg. route, view, commands
     * @return array The configuration
     */
    function getConfig($key)
    {
        return require_once base_path('config/' . $key . '.php');
    }
}

if (! function_exists('view')) {
    function view($view, $data = [])
    {
        return Backbone\Services\View::render($view, $data);
    }
}

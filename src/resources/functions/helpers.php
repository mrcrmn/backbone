<?php
/**
 * Helper functions for the Backbone Framework
 *
 * @package Backbone
 * @author Marco Reimann <marcoreimann@outlook.de>
 */

if (! function_exists('dd')) {
    /**
     * A debug method, which displays var_dumped data nicely and then dies.
     *
     * @param  mixed $var The var to debug.
     *
     * @return string The var_dump.
     */
    function dd($var)
    {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
        die();
    }
}

if (! function_exists('env')) {
    /**
     * This function gets a value by key from the environment.
     *
     * @param  string $key     The key.
     * @param  mixed $default The default value if the key isn't set.
     *
     * @return mixed
     */
    function env($key, $default = null)
    {
        return getenv($key) ?: $default;
    }
}

if (! function_exists('asset')) {
    /**
     * View helper function for assets and versioning.
     *
     * @param string $file The filepath in the public directory.
     *
     * @return string The full filepath with version number.
     */
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
    /**
     * Returns a rendered view.
     *
     * @param  string $view The name of the view.
     * @param  array  $data The data for the view.
     *
     * @return string The rendered view.
     */
    function view($view, $data = [])
    {
        return Backbone\Services\View::render($view, $data);
    }
}

if (! function_exists('redirect')) {
    /**
     * Helper funtion for a redirect response.
     *
     * @param  string $url The url to redirect to.
     *
     * @return \Backbone\Http\Response The redirected response.
     */
    function redirect($url)
    {
        return Backbone\Http\Response::redirect($url);
    }
}

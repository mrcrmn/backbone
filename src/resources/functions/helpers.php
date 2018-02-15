<?php

if (! function_exists('dd')) {
    function dd($var) {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
        die();
    }
}

if (! function_exists('env')) {
    function env($key, $default = null) {
        return getenv($key) ?: $default;
    }
}

if (! function_exists('view')) {
    function view($view, $data) {
        $blade = new duncan3dc\Laravel\BladeInstance(base_path("resources/views"), base_path("storage/cache/views"));
        return $blade->render($view, $data);
    }
}

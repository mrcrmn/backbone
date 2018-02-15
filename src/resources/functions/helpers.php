<?php

// if (! function_exists('base_path')) {

//     function base_path($path)
//     {
//         return __DIR__ . '/../../../' . ltrim($path, "/");
//     }
// }

if (! function_exists('dd')) {

    function dd($var)
    {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
        die();
    }
}


if (!function_exists('env')) {

    function env($key, $default = null)
    {
        return getenv($key) ?: $default;
    }
}
<?php

/**
 * A very helpful base path function.
 *
 * @param string $path Specify the file path
 * @return string
 */
function base_path($path = '')
{
    return __DIR__ . '/../' . ltrim($path, "/");
}

/**
 * The most important line in the whole project.
 */
require_once base_path('vendor/autoload.php');


/**
 * Load the Environment.
 */
$dotenv = new Symfony\Component\Dotenv\Dotenv();
$dotenv->load(base_path('.env'));

/**
 * Enable Error Messages if in Debug mode.
 */
if (env('APP_DEBUG') == 'true') {
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}

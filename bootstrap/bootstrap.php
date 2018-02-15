<?php

/**
 * A very helpful base path function.
 *
 * @param string $path
 * @return string
 */
function base_path($path = '') {
    return __DIR__ . '/../' . ltrim($path, "/");
}

/**
 * Load the Environment.
 */
$dotenv = new Symfony\Component\Dotenv\Dotenv();
$dotenv->load(base_path('.env'));

/**
 * Enable Error Messages if in Debug mode.
 */
if (getenv('DEBUG') == 'true') {
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}

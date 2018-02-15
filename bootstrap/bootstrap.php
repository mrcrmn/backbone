<?php

function base_path($path = '') {
    return __DIR__ . '/../' . ltrim($path, "/");
}

$dotenv = new Dotenv\Dotenv(base_path());
$dotenv->load();

if (getenv('DEBUG') == 'true') {
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}

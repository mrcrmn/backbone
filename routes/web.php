<?php

$router = new mrcrmn\Backbone\Router\Router;

$router->get('/', 'ExampleController::example');

return $router;
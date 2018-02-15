<?php

$router = new mrcrmn\Backbone\Router\Router;

$router->get('/', 'TestController::test');

return $router;
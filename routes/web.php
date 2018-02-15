<?php

$router = new mrcrmn\Backbone\Router\Router;

$router->get('/test/{test}', 'TestController::test');

return $router;
<?php

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $router) {
    $router->get('/test/{param}', 'TestController::test');
});

return $dispatcher;
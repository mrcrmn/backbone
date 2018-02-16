<?php

$router = new Backbone\Router\Router;

/**
 * -------------------------------------------------------
 * Add Routes here.
 * -------------------------------------------------------
 */

$router->get('/{test}', 'ExampleController::example');

/**
 * -------------------------------------------------------
 */
return $router;

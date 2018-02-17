<?php

$router = new Backbone\Router\Router;

/**
 * -------------------------------------------------------
 * Add Routes here.
 * -------------------------------------------------------
 */

$router->get('/', 'ExampleController::example');

/**
 * -------------------------------------------------------
 */
return $router;

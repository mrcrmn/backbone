<?php

$router = new mrcrmn\Backbone\Router\Router;

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

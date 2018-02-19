<?php

define('START', microtime(true));

/**
 * First we'll bootstrap needed functions and debug methods.
 */
require_once __DIR__ . '/../bootstrap/bootstrap.php';

/**
 * Next we'll create a new Symfony Request Object from the Globals.
 */
$request = Symfony\Component\HttpFoundation\Request::createFromGlobals();

/**
 * After that we instanciate the Kernel.
 */
$kernel = new Backbone\Http\Kernel(new Backbone\Foundation\Application);

/**
 * The Kernel handles the Request and transforms it into the Response.
 */
$response = $kernel->handle($request);

/**
 * Finally we send the response to the client.
 */
$response->send();

/**
 * Terminate the kernel.
 */
$kernel->terminate($request, $response);

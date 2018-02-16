<?php

/**
 * First we need to require the autoloader.
 */
require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Now we'll bootstrap needed functions and debug methods.
 */
require_once __DIR__ . '/../bootstrap/bootstrap.php';

/**
 * Next we'll create a new Symfony Request Object fromn the Globals.
 */
$request = Symfony\Component\HttpFoundation\Request::createFromGlobals();

/**
 * After that we instanciate the Kernel.
 */
$kernel = new mrcrmn\Backbone\Http\Kernel();

/**
 * The Kernel handles the Request and transforms it into the Response.
 */
$response = $kernel->handle($request);

/**
 * Finally we send the response to the client.
 */
$response->send();

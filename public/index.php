<?php

require_once __DIR__ . '/../vendor/autoload.php';

$request = Symfony\Component\HttpFoundation\Request::createFromGlobals();

$kernel = new mrcrmn\Backbone\Http\Kernel();

$response = $kernel->handle($request);

$response->send();

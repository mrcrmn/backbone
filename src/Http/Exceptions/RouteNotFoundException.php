<?php

namespace Backbone\Http\Exceptions;

use \Exception;

class RouteNotFoundException extends Exception
{
    public function __construct(...$args)
    {
        parent::__construct(...$args);
    }
}

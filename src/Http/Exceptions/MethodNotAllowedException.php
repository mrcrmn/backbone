<?php

namespace Backbone\Http\Exceptions;

use \Exception;

class MethodNotAllowedException extends Exception
{
    public function __construct(...$args)
    {
        parent::__construct(...$args);
    }
}

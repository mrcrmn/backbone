<?php

namespace Backbone\Foundation\Exceptions;

use Exception;
use Psr\Container\NotFoundExceptionInterface;

/**
 *
 */
class ServiceNotFoundException extends Exception implements NotFoundExceptionInterface
{
}

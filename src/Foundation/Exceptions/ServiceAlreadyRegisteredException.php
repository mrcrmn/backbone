<?php

namespace Backbone\Foundation\Exceptions;

use Exception;
use Psr\Container\ContainerExceptionInterface;

/**
 *
 */
class ServiceAlreadyRegisteredException extends Exception implements ContainerExceptionInterface
{
}

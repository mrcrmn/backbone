<?php

namespace Backbone\Facades;

abstract class Facade
{
    protected static $hasBeenBooted = false;

    protected abstract static function boot();
}

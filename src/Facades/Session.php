<?php

namespace Backbone\Facades;

use Backbone\Facades\Facade;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * The session facade.
 *
 * @package Backbone
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
class Session extends Facade
{
    /**
     * Determine if the Facade has been booted.
     *
     * @var bool
     */
    public static $hasBeenBooted = false;

    /**
     * The Session instance.
     *
     * @var \Symfony\Component\HttpFoundation\Session\Session;
     */
    protected static $session;

    /**
     * Boots the Facade.
     *
     * @return void
     */
    protected static function boot()
    {
        self::$session = new Session();
        self::$session->start();
    }

    /**
     * Returns the service to the facade.
     *
     * @return \Symfony\Component\HttpFoundation\Session\Session;
     */
    protected static function getService()
    {
        return self::$session;
    }
}

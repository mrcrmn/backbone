<?php

namespace Backbone\Facades;

use Backbone\Facades\Facade;
use Symfony\Component\HttpFoundation\Session\Session as SymfonySession;

/**
 * The session facade.
 *
 * @package Backbone
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
class Session extends Facade
{
    /**
     * The name of the service.
     *
     * @var string
     */
    protected const SERVICE_NAME = 'session';

    /**
     * Determine if the Facade has been booted.
     *
     * @var bool
     */
    public static $hasBeenBooted = false;

    /**
     * Boots the Facade.
     *
     * @return void
     */
    protected static function boot()
    {
        $session = new SymfonySession();
        $session->start();
        static::$app->register(self::SERVICE_NAME, $session);
    }
}

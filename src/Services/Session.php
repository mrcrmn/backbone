<?php

namespace Backbone\Services;

use Backbone\Services\Service;
use Symfony\Component\HttpFoundation\Session\Session as SymfonySession;

/**
 * The session Service.
 *
 * @package Backbone
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
class Session extends Service
{
    /**
     * The name of the service.
     *
     * @var string
     */
    protected const SERVICE_NAME = 'session';

    /**
     * Determine if the Service has been booted.
     *
     * @var bool
     */
    public static $hasBeenBooted = false;

    /**
     * Boots the Service.
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

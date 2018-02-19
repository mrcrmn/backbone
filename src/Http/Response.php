<?php

namespace Backbone\Http;

use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * A wrapper for the Symfony Response.
 *
 * @package Backbone
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
class Response extends SymfonyResponse
{
    /**
     * Returns a redirect response.
     *
     * @param string $url The Uri to redirect to.
     *
     * @return \Backbone\Http\Response
     */
    public static function redirect($url)
    {
        $response = new self(null, 302);
        $response->headers->set('Location', $url);

        return $response;
    }
}

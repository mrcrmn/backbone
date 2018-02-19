<?php

namespace Backbone\Http;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * A wrapper for the Symfony Response
 *
 * @package Backbone
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
class Response extends SymfonyResponse
{
    /**
     * Returns a redirect response.
     *
     * @param string $uri The Uri to redirect to.
     * @param int   $status The status code.
     * @param array $headers The headers.
     *
     * @return RedirectResponse
     */
    public static function redirect($uri)
    {
        $response = new self(null, Response::HTTP_FOUND);

        $response->headers->set('Location', $uri);

        return $response;
    }
}

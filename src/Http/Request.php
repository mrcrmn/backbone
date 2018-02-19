<?php

namespace Backbone\Http;

use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

/**
 * A wrapper for the Symfony Request.
 *
 * @package Backbone
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
class Request extends SymfonyRequest
{
    /**
     * Sets the Request attributes based on the route info.
     *
     * @param array $attributes The dynamic uri attributes.
     *
     * @return void
     */
    public function setAttributes($attributes)
    {
        $this->attributes->add($attributes);
    }

    /**
     * Retrieves a value from the attribute bag.
     *
     * @param  string $key The attribute key.
     *
     * @return mixed The attribute value.
     */
    public function attr($key)
    {
        return $this->attributes->get($key);
    }
}

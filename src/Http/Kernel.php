<?php

namespace Backbone\Http;

use Exception;
use Backbone\Facades\View;
use Backbone\Http\RouteResolver;
use Backbone\Http\ControllerResolver;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Backbone\Http\Exceptions\RouteNotFoundException;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Backbone\Http\Exceptions\MethodNotAllowedException;

/**
 * The kernel class which turns requests into responses.
 *
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
class Kernel implements HttpKernelInterface
{
    /**
     * The Request Object.
     *
     * @var \Symfony\Component\HttpFoundation\Request
     */
    public $request;

    /**
     * The main function which turns the Request into a Response.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request The request instance
     * @param int $type The type of the request
     * @param bool $catch Whether exeptions should be caught
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        $this->request = $request;

        try {
            // Try running the router and catch exceptions.
            $routeInfo = RouteResolver::resolve($this->request);
        } catch (RouteNotFoundException $e) {
            return $this->abort(Response::HTTP_NOT_FOUND);
        } catch (MethodNotAllowedException $e) {
            return $this->abort(Response::HTTP_METHOD_NOT_ALLOWED);
        }

        // If the routes contains attributes, add them to the attributes request parameter bag.
        if (isset($routeInfo[2])) {
            $this->setRequestAttributes($routeInfo[2]);
        }

        $content = ControllerResolver::resolve($routeInfo[1], $this->request);

        return new Response($content, Response::HTTP_OK);
    }

    /**
     * Sets the Request attributes based on the route info.
     *
     * @param array $attributes The dynamic Uri Attributes
     * @return void
     */
    protected function setRequestAttributes($attributes)
    {
        $this->request->attributes->add($attributes);
    }

    /**
     * Aborts the request and sends an error response
     *
     * @param  int $status HTTP status code
     * @return \Symfony\Component\HttpFoundation\Response The Response instance
     */
    protected function abort($status)
    {
        return new Response(View::render('errors.'.$status), $status, ['content-type' => 'text/html']);
    }
}

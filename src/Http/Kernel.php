<?php

namespace Backbone\Http;

use Backbone\Http\RouteResolver;
use Backbone\Http\ControllerResolver;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

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
     *
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        $this->request = $request;

        $routeInfo = RouteResolver::resolve($this->request);

        if (isset($routeInfo[2])) {
            $this->setRequestAttributes($routeInfo);
        }

        if (! $this->resolveRouteStatusCode($routeInfo[0])) {
            // Todo
            return new Response("404");
        }

        $content = ControllerResolver::resolve($routeInfo, $this->request);

        return new Response($content);
    }

    /**
     * We check if the Route is found and check if the method is allowed.
     *
     * @param int $statusCode
     *
     * @return void
     */
    protected function resolveRouteStatusCode($statusCode)
    {
        switch ($statusCode) {

            case \FastRoute\Dispatcher::NOT_FOUND:
                return false;
                break;

            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                throw new \Exception("Method not allowed. Must use {$allowedMethods}.");
                break;

            case \FastRoute\Dispatcher::FOUND:
                return true;
                break;
        }
    }

    /**
     * Sets the Request attributes based on the route info.
     *
     * @param array $routeInfo the dynamic Uri Attributes
     *
     * @return void
     */
    protected function setRequestAttributes($routeInfo)
    {
        $this->request->attributes->add($routeInfo[2]);
    }

}

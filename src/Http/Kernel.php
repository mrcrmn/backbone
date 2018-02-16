<?php

namespace mrcrmn\Backbone\Http;

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
     * The Router Object.
     *
     * @var \mrcrmn\Backbone\Router\Router
     */
    protected $dispatcher;

    /**
     * The Controller Namespace.
     *
     * @var string
     */
    protected const NAMESPACE = "\\App\\Http\\";

    /**
     * The main function which turns the Request into a Response.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request The request instance
     * @param int $type The type of the request
     * @param boolean $catch Whether exeptions should be caught
     *
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        $this->request = $request;

        $this->router = require_once base_path('routes/web.php');
        $routeInfo = $this->router->dispatch($this->getHttpMethod(), $request->getRequestUri());

        if (! $this->resolveRouteStatusCode($routeInfo[0])) {
            // Todo
            return new Response("404");
        }

        $content = $this->resolveController($routeInfo);

        return new Response($content);
    }

    /**
     * Gets the HTTP Request method from the Request Object.
     *
     * @return string The Http Method
     */
    protected function getHttpMethod()
    {
        return $this->request->server->get('REQUEST_METHOD');
    }

    /**
     * Resolves the Controller and calls it.
     *
     * @param array $routeInfo The matched Route Info
     * @return void
     */
    protected function resolveController($routeInfo) {

        if (isset($routeInfo[2])) {
            $this->setRequestAttributes($routeInfo[2]);
        }

        $controller = self::NAMESPACE . $routeInfo[1];

        return call_user_func_array($controller, [$this->request]);
    }

    /**
     * We check if the Route is found and check if the method is allowed.
     *
     * @param int $statusCode
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
     * @param array $attributes The dynamic Uri Attributes
     * @return void
     */
    protected function setRequestAttributes($attributes)
    {
        $this->request->attributes->add($attributes);
    }
}

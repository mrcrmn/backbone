<?php

namespace Backbone\Http;

use Exception;
use Backbone\Services\DB;
use Backbone\Services\Log;
use Backbone\Services\View;
use Backbone\Http\RouteResolver;
use Backbone\Foundation\Application;
use Backbone\Http\ControllerResolver;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Backbone\Http\Exceptions\RouteNotFoundException;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Backbone\Http\Exceptions\MethodNotAllowedException;

/**
 * The kernel class which turns requests into responses.
 *
 * @package Backbone
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
     * The app instance.
     *
     * @var \Backbone\Foundation\Application
     */
    public $app;

    /**
     * When a new kernel is created, we also create a new App container instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->app = new Application;
    }

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
            return $this->abort(Response::HTTP_NOT_FOUND, $e->getMessage());
        } catch (MethodNotAllowedException $e) {
            return $this->abort(Response::HTTP_METHOD_NOT_ALLOWED, $e->getMessage());
        }

        // If the routes contains attributes, add them to the attributes request parameter bag.
        if (isset($routeInfo[2])) {
            $this->setRequestAttributes($routeInfo[2]);
        }

        try {
            $content = ControllerResolver::resolve($routeInfo[1], $this->request);
        } catch (Exception $e) {
            if (! env('APP_DEBUG', false)) {
                return $this->abort(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
            }
        }

        return new Response($content, Response::HTTP_OK, ['content-type' => 'text/html']);
    }

    /**
     * Sets the Request attributes based on the route info.
     *
     * @param array $attributes The dynamic uri attributes
     * @return void
     */
    protected function setRequestAttributes($attributes)
    {
        $this->request->attributes->add($attributes);
    }

    /**
     * Aborts the request and sends an error response.
     *
     * @param  int $status The HTTP status code
     * @param  string $msg The error message to display
     * @return \Symfony\Component\HttpFoundation\Response The Response instance
     */
    protected function abort($status, $msg = 'Something went wrong')
    {
        return new Response(
            View::render('errors.error', ['error' => $status, 'msg' => $msg]),
            $status,
            ['content-type' => 'text/html']
        );
    }

    /**
     * Terminates the kernel.
     *
     * @param  \Symfony\Component\HttpFoundation\Request   $request  The request object
     * @param  \Symfony\Component\HttpFoundation\Response  $response The response obeject
     * @return void
     */
    public function terminate(Request $request, Response $response)
    {
        if (DB::$hasBeenBooted) {
            DB::close();
        }

        define('END', microtime(true));
        $time = (END - START) * 1000;

        Log::debug("Request time was {$time}ms.");
        die();
    }
}

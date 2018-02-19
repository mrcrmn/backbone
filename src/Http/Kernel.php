<?php

namespace Backbone\Http;

use Exception;
use Backbone\Services\DB;
use Backbone\Services\Log;
use Backbone\Http\Request;
use Backbone\Http\Response;
use Backbone\Services\View;
use Backbone\Http\RouteResolver;
use Backbone\Foundation\Application;
use Backbone\Http\ControllerResolver;
use Backbone\Http\Exceptions\RouteNotFoundException;
use Backbone\Http\Exceptions\MethodNotAllowedException;

/**
 * The kernel class which turns requests into responses.
 *
 * @package Backbone
 * @author Marco Reimann <marcoreimann@outlook.de>
 */
class Kernel
{
    /**
     * The Request Object.
     *
     * @var \Backbone\Http\Request
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
     * @param \Backbone\Http\Request $request The request instance.
     *
     * @return \Backbone\Http\Request
     */
    public function handle(Request $request)
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

        try {
            $content = ControllerResolver::resolve($routeInfo[1], $this->request);

            if ($content instanceof Response) {
                return $content;
            }
        } catch (Exception $e) {
            return $this->abort(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }

        return new Response($content, Response::HTTP_OK, ['content-type' => 'text/html']);
    }

    /**
     * Aborts the request and sends an error response.
     *
     * @param  int $status The HTTP status code.
     * @param  string $msg The error message to display.
     *
     * @return \Backbone\Http\Response The Response instance
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
     * @param  \Backbone\Http\Request   $request  The request object.
     * @param  \Backbone\Http\Response  $response The response obeject.
     *
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

<?php

namespace mrcrmn\Backbone\Http;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class Kernel implements HttpKernelInterface
{

    public $request;

    protected $dispatcher;

    protected const NAMESPACE = "\\App\\Http\\";

    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        $this->request = $request;
        $this->dispatcher = require_once base_path('routes/web.php');


        $routeInfo = $this->dispatcher->dispatch($this->getHttpMethod(), $this->getUri());
        $this->resolveController($routeInfo);
    }

    protected function getHttpMethod()
    {
        return $this->request->server->get('REQUEST_METHOD');
    }

    protected function getUri()
    {
        $uri = $this->request->server->get('REQUEST_URI');
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        return $uri;
    }

    protected function resolveController($routeInfo) {
        $params = $routeInfo[2];

        $controller = self::NAMESPACE . $routeInfo[1];

        call_user_func_array($controller, [$this->request, $params]);
    }
}

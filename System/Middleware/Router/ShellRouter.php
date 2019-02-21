<?php
namespace Evie\Monitor\System\Middleware\Router;

use Evie\Monitor\System\Controller\Responder;
use Evie\Monitor\System\Middleware\Base\Middleware;
use Evie\Monitor\System\Request\Request;

/**
 * Class ShellRouter.
 * PHP-CLI commands router.
 * @package Evie\MonitorController\System\Middleware\Router
 */
class ShellRouter implements IRouter  {

    /**
     * Application response.
     * @var $_responder IResponse
     */
    private $_responder;

    /**
     * Middleware list.
     * @var $_middleware array
     */
    private $_middleware = [];

    /**
     * Handlers list.
     * @var $_handlers array
     */
    private $_handlers   = [];

    public function __construct(Responder $responder, array $routes){
        $this->_responder = $responder;
    }

    private function numbers(Request $request) : array {
        $path = explode('/', trim($request->path(), '/'));
        //array_unshift($path, $method);
        return $this->_routes->match($path);
    }

    public function handle(Request $request)   {
        $routeNumbers = $this->_getRouteNumbers($request);
        if (count($routeNumbers) == 0) {
            return $this->_responder->error();
        }
        return call_user_func($this->_routeHandlers[$routeNumbers[0]], $request);
    }

    public function load(Middleware $middleware)    {
        $next = count($this->_middleware) > 0 ? $this->_middleware[0] : $this;
        $middleware->setNext($next);
        array_unshift($this->_middleware, $middleware);
    }

    public function route(Request $request)    {
        return count($this->_middleware) > 0
            ? $this->_middleware[0]->handle($request)
            : $this->handle($request);
    }

}
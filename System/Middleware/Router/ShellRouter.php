<?php
namespace Evie\Monitor\System\Middleware\Router;

use Evie\Monitor\System\Middleware\Base\Middleware;
use Evie\Monitor\System\Request\Request;

/**
 * Class ShellRouter.
 * PHP-CLI commands router.
 * @package Evie\MonitorController\System\Middleware\Router
 */
class ShellRouter implements IRouter  {

    private $_middleware = [];
    private $_handlers   = [];

    public function __construct(array $routes){

    }

    public function handle(Request $request)   {

    }

    public function register()  {
        // TODO: Implement register() method.
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
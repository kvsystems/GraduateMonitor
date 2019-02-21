<?php
namespace Evie\Monitor\System\Middleware\Router;

use Evie\Monitor\System\Config;
use Evie\Monitor\System\Controller\Responder;
use Evie\Monitor\System\Middleware\Base\Middleware;
use Evie\Monitor\System\Request\Request;
use Evie\Monitor\System\Response\IResponse;

/**
 * Class ShellRouter.
 * PHP-CLI commands router.
 * @package Evie\MonitorController\System\Middleware\Router
 */
class ShellRouter implements IRouter  {

    /**
     * Application response.
     * @var $_responder Responder
     */
    private $_responder;

    /**
     * Middleware list.
     * @var $_middleware array
     */
    private $_middleware = [];

    /**
     * Routes list.
     * @var $_routes array
     */
    private $_routes = [];

    /**
     * Sets responder and available routes.
     * ShellRouter constructor.
     * @param Responder $responder
     * @param array $routes
     */
    public function __construct(Responder $responder, array $routes){
        $this->_responder = $responder;
        $config = new Config();
        $this->_routes = $config->getRoutes();
    }

    /**
     * Gets request route.
     * @param Request $request
     * @return array
     */
    private function _match(Request $request) : array {
        $path = $request->path()->value();
        $match =  isset($this->_routes[$path])
            ? explode('@', $this->_routes[$path])
            : explode('@', $this->_routes[0]);
        $match[0] = ucfirst($match[0] . 'Controller');
        return $match;
    }

    /**
     * Handles request.
     * @param Request $request
     * @return IResponse
     */
    public function handle(Request $request) : IResponse {
        $controller = $this->_match($request);
        return call_user_func($controller, $request);
    }

    /**
     * Loads middleware.
     * @param Middleware $middleware
     */
    public function load(Middleware $middleware)    {
        $next = count($this->_middleware) > 0 ? $this->_middleware[0] : $this;
        $middleware->setNext($next);
        array_unshift($this->_middleware, $middleware);
    }

    /**
     * Handles route.
     * @param Request $request
     * @return IResponse
     */
    public function route(Request $request)  : IResponse  {
        return count($this->_middleware) > 0
            ? $this->_middleware[0]->handle($request)
            : $this->handle($request);
    }

    /**
     * Gets controller.
     * @param Request $request
     * @return string
     */
    public function controller(Request $request) : string  {
        return $this->_match($request)[0];
    }

    /**
     * Gets action.
     * @param Request $request
     * @return string
     */
    public function action(Request $request) : string {
        return $this->_match($request)[1];
    }

    /**
     * Gets action.
     * @param Request $request
     * @return string
     */
    public function service(Request $request) : string {
        return str_replace('Controller', 'Service', $this->_match($request)[0]);
    }

}
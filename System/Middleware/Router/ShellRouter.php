<?php
namespace Evie\Monitor\System\Middleware\Router;

use Evie\Monitor\System\Config;
use Evie\Monitor\System\Controller\Responder;
use Evie\Monitor\System\Middleware\Base\Middleware;
use Evie\Monitor\System\Request\Request;
use Evie\Monitor\System\Response\IResponse;
use Evie\Monitor\System\Controller\GenericController;

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
     * Application request.
     * @var $_request Request
     */
    private $_request;

    /**
     * Handler.
     * @var $_handler array
     */
    private $_handler = [];

    /**
     * Sets responder and available routes.
     * ShellRouter constructor.
     * @param Responder $responder
     * @param array $routes
     */
    public function __construct(Responder $responder, array $routes, Request $request){
        $this->_responder = $responder;
        $config = new Config();
        $this->_routes = $config->getRoutes();
        $this->_request = $request;
    }

    /**
     * Gets request route.
     * @return array
     */
    private function _match() : array {
        $path = $this->_request->path()->value();
        $match =  isset($this->_routes[$path])
            ? explode('@', $this->_routes[$path])
            : explode('@', $this->_routes['monitor/default']);
        $match[0] = ucfirst($match[0] . 'Controller');
        return $match;
    }

    /**
     * Handles request.
     * @return IResponse
     */
    public function handle() : IResponse {
        return ($this->_match()[1] == 'default')
            ? $this->_responder->error()
            : call_user_func($this->_handler, $this->_request);
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
     * @return IResponse
     */
    public function route()  : IResponse  {
        return count($this->_middleware) > 0
            ? $this->_middleware[0]->handle()
            : $this->handle();
    }

    /**
     * Registers handler.
     * @param GenericController $handler
     * @param string $action
     */
    public function register(GenericController $handler, string $action)  {
        $this->_handler = [$handler, $action];
    }

    /**
     * Gets controller.
     * @return string
     */
    public function controller() : string  {
        return $this->_match()[0];
    }

    /**
     * Gets action.
     * @return string
     */
    public function action() : string {
        return $this->_match()[1];
    }

    /**
     * Gets action.
     * @return string
     */
    public function service() : string {
        return str_replace('Controller', 'Service', $this->_match()[0]);
    }
}
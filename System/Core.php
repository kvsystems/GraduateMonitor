<?php
namespace Evie\Monitor\System;

use Evie\Monitor\System\Middleware\Base\Middleware;
use Evie\Monitor\System\Middleware\Router\IRouter;
use Evie\Monitor\System\Middleware\Router\RouterFactory;
use Evie\Monitor\System\Request\Keys\DefaultKey;
use Evie\Monitor\System\Request\Request;
use Evie\Monitor\System\Request\RequestFactory;
use Evie\Monitor\System\Response\DefaultResponse;
use Evie\Monitor\System\Response\IResponse;
use Evie\Monitor\System\Controller\Responder;

/**
 * Class Core.
 * Based application logic.
 * @package Evie\MonitorController\System
 */
class Core  {

    /**
     * Application instance.
     * @var $_instance Core
     */
    private static $_instance;

    /**
     * Application router.
     * @var IRouter
     */
    private $_router;

    /**
     * Application request.
     * @var Request
     */
    private $_request;

    /**
     * Application responder.
     * @var IResponse
     */
    private $_responder;

    /**
     * The limitation of magical creation methods.
     */
    private function __construct()  {}
    private function __clone()  {}

    /**
     * Creates application.
     * @return Core
     */
    public static function instance()   {
        return self::$_instance === null
            ? self::$_instance = new static
            : self::$_instance;
    }

    /**
     * Application initialization.
     * @return Core
     */
    public function init()   {
        $config           = new Config();
        $this->_request   = RequestFactory::request();
        $this->_responder = new Responder($config->getResponder());
        $this->_router    = RouterFactory::router(
            $config->getRouter(), $this->_responder, $config->getRoutes()
        );

        foreach($config->getMiddleware() as $middleware) {
            Middleware::create($middleware, $this->_router);
        }

        $controller = $this->_router->controller($this->_request);
        $service    = $this->_router->service($this->_request);
        new $service($controller, $this->_request);

        return $this;
    }

    /**
     * Application lookup.
     * @return IResponse
     */
    public function handle() : IResponse {
        $response = $this->_router->route($this->_request);
        return $response;
    }

}
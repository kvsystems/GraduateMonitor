<?php
namespace Evie\Monitor\System;

use Evie\Monitor\System\Controller\GenericController;
use Evie\Monitor\System\Middleware\Base\Middleware;
use Evie\Monitor\System\Middleware\Router\IRouter;
use Evie\Monitor\System\Middleware\Router\RouterFactory;
use Evie\Monitor\System\Request\Request;
use Evie\Monitor\System\Request\RequestFactory;
use Evie\Monitor\System\Response\IResponse;
use Evie\Monitor\System\Controller\Responder;
use Evie\Monitor\System\Service\GenericService;;

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
            $config->getRouter(), $this->_responder, $config->getRoutes(), $this->_request
        );

        foreach($config->getMiddleware() as $middleware) {
            Middleware::create($middleware, $this->_router);
        }

        $controller = $this->_router->controller();
        $service    = $this->_router->service();

        GenericController::controller(
            $controller, GenericService::service($service, $this->_request), $this->_responder, $this->_router
        );

        return $this;
    }

    /**
     * Application lookup.
     * @return IResponse
     */
    public function handle() : IResponse {
        $response = $this->_router->route();
        return $response;
    }

}
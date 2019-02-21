<?php
namespace Evie\Monitor\System\Middleware\Base;

use Evie\Monitor\System\Middleware\Router\IRouter;

/**
 * Class Middleware.
 * @package Evie\MonitorController\System\Middleware\Base
 */
abstract class Middleware implements IHandler    {

    /**
     * Next handler.
     * @var $next IHandler
     */
    protected $next;

    /**
     * Middleware constructor.
     * Sets the type of intermediate processing.
     * @param IRouter $router
     */
    public function __construct(IRouter $router)   {
        $router->load($this);
    }

    /**
     * Sets next middleware.
     * @param IHandler $handler
     */
    public function setNext(IHandler $handler)   {
        $this->next = $handler;
    }

    /**
     * Creates middleware of the desired type.
     * @param string $type
     * @param IRouter $router
     * @return Middleware
     */
    public static function create(string $type, IRouter $router) : Middleware {
        $type = str_replace( 'Base\\', '',__NAMESPACE__ . '\\' . ucfirst($type) . 'Middleware');
        return new $type($router);
    }
}
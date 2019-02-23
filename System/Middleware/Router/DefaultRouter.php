<?php
namespace Evie\Monitor\System\Middleware\Router;

use Evie\Monitor\System\Middleware\Base\Middleware;
use Evie\Monitor\System\Response\IResponse;
use Evie\Monitor\System\Controller\GenericController;
use Evie\Monitor\System\Response\ResponseFactory;

/**
 * Class DefaultRouter.
 * Default application router.
 * @package Evie\MonitorController\System\Middleware\Router
 */
class DefaultRouter implements IRouter  {

    public function handle() : IResponse  {
        return ResponseFactory::response('default');
    }

    public function load(Middleware $middleware)    {
        // TODO: Implement load() method.
    }

    public function route()    {
        // TODO: Implement route() method.
    }

    /**
     * Registers handler.
     * @param GenericController $handler
     * @param string $action
     */
    public function register(GenericController $handler, string $action)  {

    }

    /**
     * Gets controller.
     * @return string
     */
    public function controller(): string    {
        return '';
    }

    /**
     * Gets action.
     * @return string
     */
    public function action(): string    {
        return '';
    }

    /**
     * Gets action.
     * @return string
     */
    public function service(): string   {
        return '';
    }
}
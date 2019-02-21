<?php
namespace Evie\Monitor\System\Middleware\Router;

use Evie\Monitor\System\Middleware\Base\Middleware;
use Evie\Monitor\System\Request\Request;
use Evie\Monitor\System\Response\IResponse;

/**
 * Class DefaultRouter.
 * Default application router.
 * @package Evie\MonitorController\System\Middleware\Router
 */
class DefaultRouter implements IRouter  {

    public function handle(Request $request) : IResponse  {
        // TODO: Implement handle() method.
    }

    public function load(Middleware $middleware)    {
        // TODO: Implement load() method.
    }

    public function route(Request $request)    {
        // TODO: Implement route() method.
    }

    /**
     * Register controller route.
     */
    public function register(string $path, array $handler)  {

    }

}
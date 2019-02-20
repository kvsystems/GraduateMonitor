<?php
namespace Evie\Monitor\System\Middleware\Router;

use Evie\Monitor\System\Middleware\Base\Middleware;
use Evie\Monitor\System\Request\Request;

/**
 * Class HttpRouter.
 * HTTP 1.1 requests router.
 * @package Evie\MonitorController\System\Middleware\Router
 */
class HttpRouter implements IRouter  {

    public function __construct(array $routes)  {

    }

    public function handle(Request $request)   {
        // TODO: Implement handle() method.
    }

    public function register()  {
        // TODO: Implement register() method.
    }

    public function load(Middleware $middleware)    {
        // TODO: Implement load() method.
    }

    public function route(Request $request)    {
        // TODO: Implement route() method.
    }

}
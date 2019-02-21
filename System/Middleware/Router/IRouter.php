<?php
namespace Evie\Monitor\System\Middleware\Router;

use Evie\Monitor\System\Middleware\Base\IHandler;
use Evie\Monitor\System\Middleware\Base\Middleware;
use Evie\Monitor\System\Request\Request;

/**
 * Interface IRouter.
 * Defines the appearance of the application router.
 * @package Evie\MonitorController\System\Middleware\Router
 */
interface IRouter extends IHandler {

    public function load(Middleware $middleware);
    public function route(Request $request);

}
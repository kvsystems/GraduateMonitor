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

    /**
     * Loads middleware.
     * @param Middleware $middleware
     */
    public function load(Middleware $middleware);

    /**
     * Handles route.
     * @param Request $request
     * @return IResponse
     */
    public function route(Request $request);

}
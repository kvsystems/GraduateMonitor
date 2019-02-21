<?php
namespace Evie\Monitor\System\Middleware\Router;

use Evie\Monitor\System\Middleware\Base\IHandler;
use Evie\Monitor\System\Middleware\Base\Middleware;
use Evie\Monitor\System\Request\Request;
use Evie\Monitor\System\Response\IResponse;

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

    /**
     * Register controller route.
     */
    public function register(string $path, array $handler);

    /**
     * Handles request.
     * @param Request $request
     * @return IResponse
     */
    public function handle(Request $request): IResponse;

}
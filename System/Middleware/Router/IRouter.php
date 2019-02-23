<?php
namespace Evie\Monitor\System\Middleware\Router;

use Evie\Monitor\System\Controller\GenericController;
use Evie\Monitor\System\Middleware\Base\IHandler;
use Evie\Monitor\System\Middleware\Base\Middleware;
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
     * @return IResponse
     */
    public function route();

    /**
     * Registers handler.
     * @param GenericController $handler
     * @param string $action
     */
    public function register(GenericController $handler, string $action);

    /**
     * Handles request.
     * @return IResponse
     */
    public function handle(): IResponse;

    /**
     * Gets controller.
     * @return string
     */
    public function controller() : string;
    /**
     * Gets action.
     * @return string
     */
    public function action() : string;

    /**
     * Gets action.
     * @return string
     */
    public function service() : string;

}
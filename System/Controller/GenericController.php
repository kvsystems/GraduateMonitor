<?php
namespace Evie\Monitor\System\Controller;

use Evie\Monitor\System\Middleware\Router\IRouter;
use Evie\Monitor\System\Response\IResponse;
use Evie\Monitor\System\Service\GenericService;

/**
 * Class GenericController
 * @package Evie\Monitor\System\Controller
 */
abstract class GenericController {

    /**
     * Creates controller.
     * @param string $name
     * @param GenericService $service
     * @return GenericController
     */
    public static function controller(string $name, GenericService $service, Responder $responder) : GenericController {
        $class = __NAMESPACE__ . ucfirst($name . 'Controller');
        return new $class($service, $responder);
    }

    /**
     * Default controller action.
     * @return IResponse
     */
    public abstract function default() : IResponse;
}
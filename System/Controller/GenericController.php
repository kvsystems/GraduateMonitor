<?php
namespace Evie\Monitor\System\Controller;

use Evie\Monitor\System\Response\IResponse;

/**
 * Class GenericController
 * @package Evie\Monitor\System\Controller
 */
abstract class GenericController {

    /**
     * Creates controller.
     * @param string $name
     * @return GenericController
     */
    public static function controller(string $name) : GenericController {
        $class = __NAMESPACE__ . ucfirst($name . 'Controller');
        return new $class;
    }

    /**
     * Default controller action.
     * @return IResponse
     */
    public abstract function default() : IResponse;
}
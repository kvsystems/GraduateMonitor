<?php
namespace Evie\Monitor\System\Service;

use Evie\Monitor\System\Response\IResponse;

/**
 * Class GenericService
 * @package Evie\Monitor\System\Controller
 */
abstract class GenericService {

    /**
     * Creates controller.
     * @param string $name
     * @return GenericService
     */
    public static function service(string $name) : GenericService {
        $class = __NAMESPACE__ . ucfirst($name . 'service');
        return new $class;
    }
}